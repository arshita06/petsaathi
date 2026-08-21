(function(){
function fmt(n){return '₹'+Math.round(n).toLocaleString('en-IN')}

let couponApplied=null; // {code,type,value,label}
const COUPONS={
  'PET10':{type:'percent',value:10,label:'10% off applied'},
  'FREESHIP':{type:'freeship',value:0,label:'Free delivery applied'},
  'SAVE50':{type:'flat',value:50,label:'₹50 off applied'}
};

function cartItems(){
  return getCart().map(function(ci){
    const p=products[ci.idx];
    if(!p)return null;
    return {idx:ci.idx,name:p[0],category:p[1],emoji:p[2],price:p[3],qty:ci.qty};
  }).filter(Boolean);
}

function renderItems(){
  const items=cartItems();
  const wrap=document.getElementById('orderItemsList');
  const emptyBox=document.getElementById('emptyCartBox');
  const placeBtn=document.getElementById('placeOrderBtn');
  if(!items.length){
    wrap.innerHTML='';
    emptyBox.style.display='block';
    placeBtn.disabled=true;
    renderTotals(items);
    return;
  }
  emptyBox.style.display='none';
  placeBtn.disabled=false;
  wrap.innerHTML=items.map(function(it){
    return '<div class="summary-item" data-idx="'+it.idx+'">'
      +'<div class="item-emoji">'+it.emoji+'</div>'
      +'<div class="item-info">'
        +'<div class="item-name">'+it.name+'</div>'
        +'<div class="item-variant">'+it.category+'</div>'
        +'<div class="d-flex align-items-center justify-content-between mt-2">'
          +'<div class="qty-stepper">'
            +'<button type="button" class="qty-minus" data-idx="'+it.idx+'">−</button>'
            +'<span>'+it.qty+'</span>'
            +'<button type="button" class="qty-plus" data-idx="'+it.idx+'">+</button>'
          +'</div>'
          +'<button type="button" class="item-remove" data-idx="'+it.idx+'">Remove</button>'
        +'</div>'
      +'</div>'
      +'<div class="item-price">'+fmt(it.price*it.qty)+'</div>'
    +'</div>';
  }).join('');
  renderTotals(items);
}

function renderTotals(items){
  const subtotal=items.reduce(function(s,i){return s+i.price*i.qty},0);
  let delivery=(!items.length||subtotal>=999)?0:79;
  let couponDiscount=0;
  if(couponApplied && items.length){
    if(couponApplied.type==='percent')couponDiscount=subtotal*couponApplied.value/100;
    else if(couponApplied.type==='flat')couponDiscount=Math.min(couponApplied.value,subtotal);
    else if(couponApplied.type==='freeship')delivery=0;
  }
  const taxable=Math.max(subtotal-couponDiscount,0);
  const tax=items.length?Math.round(taxable*0.05):0;
  const total=Math.max(taxable+delivery+tax,0);
  document.getElementById('subtotalVal').textContent=fmt(subtotal);
  document.getElementById('deliveryVal').textContent=delivery?fmt(delivery):'FREE';
  const discRow=document.getElementById('discountRow');
  if(couponDiscount>0){discRow.style.display='flex';document.getElementById('discountVal').textContent='−'+fmt(couponDiscount)}
  else{discRow.style.display='none'}
  document.getElementById('taxVal').textContent=fmt(tax);
  document.getElementById('totalVal').textContent=fmt(total);
  return {subtotal:subtotal,delivery:delivery,couponDiscount:couponDiscount,tax:tax,total:total};
}

function currentTotals(){return renderTotals(cartItems())}

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

document.addEventListener('click',function(e){
  const idxAttr=e.target.dataset?e.target.dataset.idx:null;
  if(idxAttr===undefined||idxAttr===null)return;
  if(e.target.classList.contains('qty-plus')){
    const c=getCart();const it=c.find(function(i){return String(i.idx)===String(idxAttr)});
    if(it){it.qty++;setCart(c);renderItems()}
  }
  if(e.target.classList.contains('qty-minus')){
    let c=getCart();const it=c.find(function(i){return String(i.idx)===String(idxAttr)});
    if(it){
      it.qty--;
      if(it.qty<=0){c=c.filter(function(i){return String(i.idx)!==String(idxAttr)});showToast('Item removed from cart','success')}
      setCart(c);renderItems();
    }
  }
  if(e.target.classList.contains('item-remove')){
    const c=getCart().filter(function(i){return String(i.idx)!==String(idxAttr)});
    setCart(c);renderItems();showToast('Item removed from cart','success');
  }
});

function initCoupon(){
  const btn=document.getElementById('applyCouponBtn');
  if(!btn)return;
  btn.addEventListener('click',function(){
    const codeInput=document.getElementById('couponInput');
    const code=codeInput.value.trim().toUpperCase();
    const msg=document.getElementById('couponMsg');
    if(!code){msg.textContent='Please enter a coupon code.';msg.style.color='#ff4d67';msg.classList.add('show');return}
    const c=COUPONS[code];
    if(!c){couponApplied=null;msg.textContent='Invalid or expired coupon code.';msg.style.color='#ff4d67';msg.classList.add('show');renderItems();return}
    couponApplied=Object.assign({code:code},c);
    msg.textContent='"'+code+'" — '+c.label+'!';
    msg.style.color='#19b877';msg.classList.add('show');
    renderItems();
    showToast('Coupon applied successfully','success');
  });
}

function initPaymentSwitch(){
  const payRadios=document.querySelectorAll('input[name="paymentMethod"]');
  const details={upi:document.getElementById('upiDetail'),card:document.getElementById('cardDetail'),cod:document.getElementById('codDetail')};
  function switchPayment(){
    const checked=document.querySelector('input[name="paymentMethod"]:checked');
    const val=checked?checked.value:'upi';
    Object.keys(details).forEach(function(k){details[k].classList.toggle('show',k===val)});
    const upiId=document.getElementById('upiId');
    if(upiId)upiId.required=(val==='upi');
    ['cardName','cardNumber','cardExpiry','cardCvv'].forEach(function(id){
      const el=document.getElementById(id);
      if(el)el.required=(val==='card');
    });
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
function isVisibleField(input){
  const parentDetail=input.closest('.pay-detail');
  if(parentDetail)return parentDetail.classList.contains('show');
  return true;
}
function validateField(input){
  if(!isVisibleField(input)){clearError(input);return true}
  clearError(input);
  if(!input.required)return true;
  const val=(input.value||'').trim();
  if(!val){setError(input);return false}
  if(input.type==='email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)){setError(input);return false}
  if(input.id==='phone' && !/^[6-9]\d{9}$/.test(val)){setError(input);return false}
  if(input.id==='pincode' && !/^\d{6}$/.test(val)){setError(input);return false}
  if(input.id==='upiId' && !/^[\w.\-]{2,}@[a-zA-Z]{2,}$/.test(val)){setError(input);return false}
  if(input.id==='cardNumber' && !/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/.test(val)){setError(input);return false}
  if(input.id==='cardExpiry' && !/^(0[1-9]|1[0-2])\/\d{2}$/.test(val)){setError(input);return false}
  if(input.id==='cardCvv' && !/^\d{3,4}$/.test(val)){setError(input);return false}
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
    e.preventDefault();
    if(submitting)return;
    const items=cartItems();
    if(!items.length){showToast('Your cart is empty. Add products before checkout.','error');return}

    let valid=true;
    form.querySelectorAll('input,select,textarea').forEach(function(inp){
      if(!validateField(inp))valid=false;
    });
    if(!valid){
      showToast('Please fix the highlighted fields.','error');
      const firstInvalid=form.querySelector('.is-invalid');
      if(firstInvalid)firstInvalid.scrollIntoView({behavior:'smooth',block:'center'});
      return;
    }

    submitting=true;
    const btn=document.getElementById('placeOrderBtn');
    const textEl=document.getElementById('placeOrderText');
    const originalText=textEl.textContent;
    btn.disabled=true;
    textEl.innerHTML='<span class="spinner-ring"></span>Placing your order...';

    setTimeout(function(){
      const totals=currentTotals();
      const payChecked=document.querySelector('input[name="paymentMethod"]:checked');
      const payVal=payChecked?payChecked.value:'upi';
      const payLabel=payVal==='upi'?'UPI':payVal==='card'?'Credit / Debit Card':'Cash on Delivery';
      const orderNumber='PS'+Math.floor(100000+Math.random()*900000);
      const order={
        orderNumber:orderNumber,
        total:totals.total,
        paymentMethod:payLabel,
        name:document.getElementById('fullName').value.trim(),
        address:document.getElementById('address').value.trim(),
        city:document.getElementById('city').value.trim(),
        state:document.getElementById('state').value,
        pincode:document.getElementById('pincode').value.trim(),
        country:document.getElementById('country').value,
        itemCount:items.reduce(function(s,i){return s+i.qty},0),
        date:new Date().toISOString()
      };
      try{localStorage.setItem('ps_last_order',JSON.stringify(order))}catch(err){}
      setCart([]);
      showToast('Order placed successfully! Redirecting…','success');
      setTimeout(function(){window.location.href='order-success.html'},900);
    },1400);
  });
}

document.addEventListener('DOMContentLoaded',function(){
  seedCartIfEmpty();
  updateCartBadge();
  renderItems();
  initCoupon();
  initPaymentSwitch();
  const form=document.getElementById('checkoutForm');
  if(form){initValidation(form);initSubmit(form)}
});
})();
