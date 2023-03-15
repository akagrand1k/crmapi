// https://stackoverflow.com/questions/1129216/sort-array-of-objects-by-string-property-value
// ?? localeCompare
Array.prototype.sortBy = function(...args) {
  function dynamicSort(property) {
      var sortOrder = 1;
      if(property[0] === "-") {
          sortOrder = -1;
          property = property.substr(1);
      }
      return function (a,b) {
          var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
          return result * sortOrder;
      }
  }
  function dynamicSortMultiple() {
      var props = arguments;
      return function (obj1, obj2) {
          var i = 0, result = 0, numberOfProperties = props.length;
          while(result === 0 && i < numberOfProperties) {
              result = dynamicSort(props[i])(obj1, obj2);
              i++;
          }
          return result;
      }
  }
  return this.sort(dynamicSortMultiple(...args)) // this.slice(0).sort
}
Array.prototype.sortCopyBy = function(...args) {
  return this.slice(0).sort(...args)
}