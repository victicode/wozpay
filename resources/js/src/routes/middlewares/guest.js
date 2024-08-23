export default function guest (_to, _from, next) {
  document.title = _to.meta.title + ' - Woz Pay'
 const isAuthenticated = window.localStorage.getItem('id_token');
 if (isAuthenticated) {
  window.localStorage.getItem('is_admin') ==  'true' ? next({ path: '/admin/dashboard' }) : next({ path: '/dashboard' });
 } else {
   next();
  }
}