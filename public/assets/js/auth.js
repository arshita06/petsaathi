(function(){

function setError(input,show){
  if(show)input.classList.add('is-invalid');else input.classList.remove('is-invalid');
  const err=document.getElementById(input.id+'Error');
  if(err)err.classList.toggle('show',!!show);
}
function isValidEmail(v){return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)}

function initTogglePass(){
  document.querySelectorAll('.toggle-pass').forEach(function(btn){
    btn.addEventListener('click',function(){
      const target=document.getElementById(btn.dataset.target);
      if(!target)return;
      const show=target.type==='password';
      target.type=show?'text':'password';
      btn.textContent=show?'🙈':'👁️';
      btn.setAttribute('aria-label',show?'Hide password':'Show password');
    });
  });
}

function showToast(msg,type){
  let stack=document.querySelector('.toast-stack');
  if(!stack){stack=document.createElement('div');stack.className='toast-stack';document.body.appendChild(stack)}
  const t=document.createElement('div');
  t.className='pt-toast '+(type||'success');
  t.innerHTML='<span>'+(type==='error'?'⚠️':'✅')+'</span><span>'+msg+'</span>';
  stack.appendChild(t);
  setTimeout(function(){
    t.style.opacity='0';t.style.transform='translateX(20px)';t.style.transition='.3s';
    setTimeout(function(){t.remove()},300);
  },3200);
}

/* ---------------- LOGIN PAGE ---------------- */
function initLoginPage(){
  const form=document.getElementById('loginForm');
  if(!form)return;

  // prefill remembered email
  try{
    const remembered=localStorage.getItem('ps_remember_email');
    if(remembered){
      document.getElementById('loginEmail').value=remembered;
      document.getElementById('rememberMe').checked=true;
    }
  }catch(e){}

  if(sessionStorage.getItem('ps_just_registered')==='1'){
    showToast('Account created! Please log in to continue.','success');
    sessionStorage.removeItem('ps_just_registered');
  }

  form.querySelectorAll('input').forEach(function(inp){
    inp.addEventListener('blur',function(){validateLoginField(inp)});
    inp.addEventListener('input',function(){if(inp.classList.contains('is-invalid'))validateLoginField(inp)});
  });

  function validateLoginField(inp){
    if(inp.id==='loginEmail'){
      const v=inp.value.trim();
      const ok=v && isValidEmail(v);
      setError(inp,!ok);
      return ok;
    }
    if(inp.id==='loginPassword'){
      const ok=inp.value.length>0;
      setError(inp,!ok);
      return ok;
    }
    return true;
  }

  let submitting=false;
  form.addEventListener('submit',function(e){
    e.preventDefault();
    if(submitting)return;
    const emailInp=document.getElementById('loginEmail');
    const passInp=document.getElementById('loginPassword');
    const okE=validateLoginField(emailInp);
    const okP=validateLoginField(passInp);
    if(!okE||!okP){
      showToast('Please fix the highlighted fields.','error');
      return;
    }
    submitting=true;
    const btn=document.getElementById('loginBtn');
    const txt=document.getElementById('loginBtnText');
    btn.disabled=true;
    txt.innerHTML='<span class="spinner-ring"></span>Logging in...';

    try{
      const remember=document.getElementById('rememberMe').checked;
      if(remember)localStorage.setItem('ps_remember_email',emailInp.value.trim());
      else localStorage.removeItem('ps_remember_email');
      localStorage.setItem('ps_logged_in','1');
    }catch(err){}

    setTimeout(function(){
      showToast('Login successful! Redirecting…','success');
      setTimeout(function(){window.location.href='profile.html'},700);
    },1100);
  });

  // forgot password panel
  const forgotLink=document.getElementById('forgotLink');
  const backLink=document.getElementById('backToLoginLink');
  const loginForm=document.getElementById('loginForm');
  const forgotPanel=document.getElementById('forgotPanel');
  const registerPrompt=document.getElementById('registerPrompt');
  const heading=document.getElementById('loginHeading');

  if(forgotLink){
    forgotLink.addEventListener('click',function(e){
      e.preventDefault();
      loginForm.style.display='none';
      registerPrompt.style.display='none';
      forgotPanel.style.display='block';
      heading.querySelector('h2').textContent='Reset Password';
      heading.querySelector('p').textContent="Enter your email — we'll help you get back in.";
    });
  }
  if(backLink){
    backLink.addEventListener('click',function(e){
      e.preventDefault();
      forgotPanel.style.display='none';
      loginForm.style.display='block';
      registerPrompt.style.display='block';
      heading.querySelector('h2').textContent='Welcome Back';
      heading.querySelector('p').textContent='Log in to continue your PetSaathi journey.';
    });
  }
  const sendResetBtn=document.getElementById('sendResetBtn');
  let resetSubmitting=false;
  if(sendResetBtn){
    sendResetBtn.addEventListener('click',function(){
      if(resetSubmitting)return;
      const resetEmail=document.getElementById('resetEmail');
      const v=resetEmail.value.trim();
      const ok=v && isValidEmail(v);
      setError(resetEmail,!ok);
      if(!ok){showToast('Please enter a valid email address.','error');return}
      resetSubmitting=true;
      const resetTxt=document.getElementById('resetBtnText');
      sendResetBtn.disabled=true;
      resetTxt.innerHTML='<span class="spinner-ring"></span>Sending...';
      setTimeout(function(){
        showToast('Reset link sent! Check your inbox.','success');
        sendResetBtn.disabled=false;
        resetTxt.textContent='Send Reset Link';
        resetSubmitting=false;
        if(backLink)backLink.click();
      },1100);
    });
  }
}

/* ---------------- REGISTER PAGE ---------------- */
function initRegisterPage(){
  const form=document.getElementById('registerForm');
  if(!form)return;

  const passInput=document.getElementById('regPassword');

  function validateField(inp){
    if(inp.id==='regName'){const ok=inp.value.trim().length>1;setError(inp,!ok);return ok}
    if(inp.id==='regEmail'){const ok=isValidEmail(inp.value.trim());setError(inp,!ok);return ok}
    if(inp.id==='regPhone'){const ok=/^[6-9]\d{9}$/.test(inp.value.trim());setError(inp,!ok);return ok}
    if(inp.id==='regPassword'){const ok=inp.value.length>=8;setError(inp,!ok);return ok}
    if(inp.id==='regConfirmPassword'){const ok=inp.value.length>0 && inp.value===passInput.value;setError(inp,!ok);return ok}
    if(inp.id==='regTerms'){const ok=inp.checked;setError(inp,!ok);return ok}
    return true;
  }

  form.querySelectorAll('input').forEach(function(inp){
    const evt=inp.type==='checkbox'?'change':'blur';
    inp.addEventListener(evt,function(){validateField(inp)});
    inp.addEventListener('input',function(){if(inp.classList.contains('is-invalid'))validateField(inp)});
  });

  let submitting=false;
  form.addEventListener('submit',function(e){
    e.preventDefault();
    if(submitting)return;
    const fields=['regName','regEmail','regPhone','regPassword','regConfirmPassword','regTerms'].map(function(id){return document.getElementById(id)});
    let valid=true;
    fields.forEach(function(inp){if(!validateField(inp))valid=false});
    if(!valid){
      showToast('Please fix the highlighted fields.','error');
      const firstInvalid=form.querySelector('.is-invalid');
      if(firstInvalid)firstInvalid.scrollIntoView({behavior:'smooth',block:'center'});
      return;
    }
    submitting=true;
    const btn=document.getElementById('registerBtn');
    const txt=document.getElementById('registerBtnText');
    btn.disabled=true;
    txt.innerHTML='<span class="spinner-ring"></span>Creating account...';

    try{
      localStorage.setItem('ps_user',JSON.stringify({
        name:document.getElementById('regName').value.trim(),
        email:document.getElementById('regEmail').value.trim(),
        phone:document.getElementById('regPhone').value.trim()
      }));
    }catch(err){}

    setTimeout(function(){
      showToast('Account created successfully! Redirecting to login…','success');
      try{sessionStorage.setItem('ps_just_registered','1')}catch(err){}
      setTimeout(function(){window.location.href='login.html'},800);
    },1200);
  });
}

document.addEventListener('DOMContentLoaded',function(){
  initTogglePass();
  initLoginPage();
  initRegisterPage();
});
})();
