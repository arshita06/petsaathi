/* The cart and wishlist now live in the database and are handled by plain
   form posts (see CartController / WishlistController), so this file only
   deals with page effects: the scroll-in reveal and the counting numbers. */
function init(){document.body.classList.add('page-transition');let io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('show')}),{threshold:.12});document.querySelectorAll('.reveal').forEach(e=>io.observe(e));document.querySelectorAll('.count').forEach(el=>{let n=+el.dataset.count,c=0,t=setInterval(()=>{c+=Math.ceil(n/45);el.textContent=c>=n?n:c;if(c>=n)clearInterval(t)},30)})}
document.addEventListener('DOMContentLoaded',init);
