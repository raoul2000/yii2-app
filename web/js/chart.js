
var chart = null;
var loadedSeries = {};
/**
 * Load the list of available packages into the dropdown select list
 */
function loadPackageList() {

  var deferred = $.Deferred();

  var packageSel = $('#package-selection');
  $.getJSON('index.php?r=packagist/find-all-package-name')
  .done(function(data){
    data.map(function(item){
      packageSel.append('<option value="'+ item.package_name +'"  >'+item.package_name+'</option>');
    });
    deferred.resolve(data);
  })
  .fail(function(error){
    deferred.reject(error);
  })
  .always(function(){
    $('#btn-select-package').removeAttr('disabled');
  });
  return deferred.promise();
}
/**
 * Unload data series from the chart for a package
 * @param  {string} package_name package name to unload
 */
function unloadPackageData(package_name) {
  if( loadedSeries.hasOwnProperty(package_name) && loadedSeries[package_name] === true) {
    chart.unload({
      ids: [package_name]
    });
    loadedSeries[package_name] = false;
  }
}

/**
 * Load data series into the chart, for a package
 * @param  {string} package_name package name
 */
function loadPackageData(package_name) {
  $('#btn-select-package').attr('disabled','disabled');
  $('#package-selection').attr('disabled','disabled');

  $.getJSON('index.php?r=packagist/search-by-package-name',{
    "name" : package_name
  })
  .done(function(data){
    console.log(data);
    var serie = [package_name].concat(data.map(function(item){
      return item.download;
    }));
    chart.load({
        columns: [
            serie
        ]
    });
    loadedSeries[package_name] = true;
  })
  .fail(function(error){
    console.log(error);
  })
  .always(function(){
    $('#btn-select-package').removeAttr('disabled');
    $('#package-selection').removeAttr('disabled');
  });
}

/**
 * Create the chart instance
 * @param  {string} selector jquery selector for the chart wrapper
 * @param  {array} columns  data series to load
 * @return {object}          the chart instance
 */
function createChart(selector,columns) {
  return c3.generate({
    bindto: selector,
    data: {
      columns: columns
    }
  });
}

/**
 * onDocument Ready
 * @type {[type]}
 */
$(function(){

  console.log("loading charts data ...");

  $('#btn-select-package').on('click',function(ev){
    var package_name = $('#package-selection option:selected').val();
    if(package_name.length !== 0) {
      if( loadedSeries.hasOwnProperty(package_name) && loadedSeries[package_name] === true) {
        unloadPackageData(package_name);
      } else {
        loadPackageData(package_name);
      }
    }
  });

  loadPackageList()
  .then(function(package_list){
    console.log(package_list);
    chart = createChart('#chart',[]);
  })
  .fail(function(error){
    console.error(error);
    alert("failed to load package list");
  });
});
