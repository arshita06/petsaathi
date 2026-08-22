(function(){
document.addEventListener('DOMContentLoaded',function(){
  updateCartBadge();
  let order=null;
  try{order=JSON.parse(localStorage.getItem('ps_last_order'))}catch(e){order=null}
  if(!order){
    document.getElementById('orderResultBox').innerHTML='<div style="font-size:56px" class="mb-2">🐾</div><h4 class="fw-bold">No recent order found</h4><p class="text-muted">Looks like you haven\'t placed an order yet.</p><a href="shop.html" class="btn btn-main mt-2">Start Shopping →</a>';
    return;
  }
  document.getElementById('orderNumberVal').textContent='Order #'+order.orderNumber;
  document.getElementById('orderTotalVal').textContent='₹'+Math.round(order.total).toLocaleString('en-IN');
  document.getElementById('orderPaymentVal').textContent=order.paymentMethod;
  const addrParts=[order.address,order.city,order.state,order.pincode,order.country].filter(Boolean);
  document.getElementById('orderAddressVal').textContent=addrParts.join(', ');
});
})();
