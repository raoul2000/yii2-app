
var chart = null;
/**
 * Load the list of available packages into the dropdown select list
 */
function loadPackageList() {
  var packageSel = $('#package-selection');
  $.getJSON('index.php?r=packagist/find-all-package-name')
  .done(function(data){
    data.map(function(item){
      packageSel.append('<option value="'+ item.package_name +'"  >'+item.package_name+'</option>');
    });
    $('#btn-select-package').removeAttr('disabled');
  })
  .fail(function(error){
    console.log(error);
  });
}

function loadPackageData(package_name) {
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
  })
  .fail(function(error){
    console.log(error);
  });
}


$(function(){

  $('#btn-select-package').on('click',function(ev){
    var package_name = $('#package-selection option:selected').val();
    if(package_name.length !== 0) {
      loadPackageData(package_name);
    }
  });

});

function createChart(selector,columns) {
  chart = c3.generate({
    bindto: selector,
    data: {
      columns: columns
    }
  });
  return chart;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}



function showChart(selector) {
  $.getJSON('index.php?r=packagist/find-all')
  .done(function(data){
    console.log(data);

    var t = data.map(function(row){
      row.create_time = formatDate(row.create_time * 1000);
      return row;
    });

    var dataCol = function(packageName, fieldName) {
      return data.filter(function(item){
        return item.package_name === packageName;
      }).map(function(item){
        return item[fieldName];
      });
    };

    var d1 = dataCol("raoul2000/yii2-jcrop-widget", "download");
    var d2 = dataCol("raoul2000/yii2-workflow", "download");

    var columns = [
      ["yii2-jcrop"].concat( d1 ),
      ["yii2-workflow"].concat( d2 ),
      ["yii2-bootswatch-asset"].concat( dataCol("raoul2000/yii2-bootswatch-asset", "download"))
    ];

    return createChart(selector,columns);
  })
  .fail(function(error){
    console.error(error);
    return null;
  });
}
