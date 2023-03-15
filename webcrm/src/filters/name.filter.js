export default function name(obj) {
    return obj.name ? 
      obj.name :
      `${obj.lastname||''} ${obj.firstname||''} ${obj.middlename||''}`
}