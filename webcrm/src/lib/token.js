const token = {
  
  exist () { return (window.localStorage.getItem('$_bbIT') !== null) },
  get () { return window.localStorage.getItem('$_bbIT') },
  save ( token ) { window.localStorage.setItem('$_bbIT', token) },
  remove () { window.localStorage.removeItem('$_bbIT') },

  existToken (key) { return (window.localStorage.getItem(key) !== null) },
  saveToken(key, token) { window.localStorage.setItem(key, token) },
  getToken(key) { return window.localStorage.getItem(key) },
  removeToken(key) { window.localStorage.removeItem(key) }

}
export default token