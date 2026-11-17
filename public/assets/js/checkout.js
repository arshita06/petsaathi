(function(){
function showToast(msg,type){
  let stack=document.querySelector('.toast-stack');
  if(!stack){stack=document.createElement('div');stack.className='toast-stack';document.body.appendChild(stack)}
  const t=document.createElement('div');
  t.className='pt-toast '+(type||'success');
  t.innerHTML='<span>'+(type==='error'?'!':'OK')+'</span><span>'+msg+'</span>';
  stack.appendChild(t);
  setTimeout(function(){
    t.style.opacity='0';t.style.transform='translateX(20px)';t.style.transition='.3s';
    setTimeout(function(){t.remove()},300);
  },3200);
}

function initPaymentSwitch(){
  const payRadios=document.querySelectorAll('input[name="paymentMethod"]');
  const details={upi:document.getElementById('upiDetail'),card:document.getElementById('cardDetail'),cod:document.getElementById('codDetail')};
  function switchPayment(){
    const checked=document.querySelector('input[name="paymentMethod"]:checked');
    const val=checked?checked.value:'cod';
    Object.keys(details).forEach(function(k){
      if(details[k])details[k].classList.toggle('show',k===val);
    });
    const methodError=document.getElementById('paymentMethodError');
    if(methodError)methodError.classList.toggle('show',val!=='cod');
  }
  payRadios.forEach(function(r){r.addEventListener('change',switchPayment)});
  switchPayment();
}

function setError(input,customMsg){
  input.classList.add('is-invalid');
  const err=document.getElementById(input.id+'Error');
  if(err){if(customMsg)err.textContent=customMsg;err.classList.add('show')}
}
function clearError(input){
  input.classList.remove('is-invalid');
  const err=document.getElementById(input.id+'Error');
  if(err)err.classList.remove('show');
}
function validateField(input){
  clearError(input);
  if(!input.required)return true;
  const val=(input.value||'').trim();
  if(!val){setError(input);return false}
  if(input.type==='email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)){setError(input);return false}
  if(input.id==='phone' && !/^[6-9]\d{9}$/.test(val)){setError(input);return false}
  if(input.id==='pincode' && !/^\d{6}$/.test(val)){setError(input);return false}
  return true;
}

function initValidation(form){
  form.querySelectorAll('input,select,textarea').forEach(function(inp){
    inp.addEventListener('blur',function(){validateField(inp)});
    inp.addEventListener('input',function(){if(inp.classList.contains('is-invalid'))validateField(inp)});
    inp.addEventListener('change',function(){if(inp.classList.contains('is-invalid'))validateField(inp)});
  });
}

function initSubmit(form){
  let submitting=false;
  form.addEventListener('submit',function(e){
    if(submitting){e.preventDefault();return}

    const payChecked=document.querySelector('input[name="paymentMethod"]:checked');
    const payVal=payChecked?payChecked.value:'cod';
    if(payVal!=='cod'){
      e.preventDefault();
      const methodError=document.getElementById('paymentMethodError');
      if(methodError)methodError.classList.add('show');
      showToast('Only Cash on Delivery is available right now.','error');
      return;
    }

    let valid=true;
    form.querySelectorAll('input,select,textarea').forEach(function(inp){
      if(!validateField(inp))valid=false;
    });
    if(!valid){
      e.preventDefault();
      showToast('Please fix the highlighted fields.','error');
      const firstInvalid=form.querySelector('.is-invalid');
      if(firstInvalid)firstInvalid.scrollIntoView({behavior:'smooth',block:'center'});
      return;
    }

    submitting=true;
    const btn=document.getElementById('placeOrderBtn');
    const textEl=document.getElementById('placeOrderText');
    if(btn)btn.disabled=true;
    if(textEl)textEl.innerHTML='<span class="spinner-ring"></span>Placing your order...';
  });
}

document.addEventListener('DOMContentLoaded',function(){
  initPaymentSwitch();
  const form=document.getElementById('checkoutForm');
  if(form){initValidation(form);initSubmit(form)}
});
})();
