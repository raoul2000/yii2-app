

function loadData() {
  return $.getJSON('index.php?r=packagist');
}

function createChart(selector,columns) {
  return c3.generate({
    bindto: selector,
    data: {
      columns: columns
    }
  });
}

function showChart(selector) {
  loadData()
  .done(function(data){
    console.log(data);

    var dataCol = function(packageName, fieldName) {
      return data.filter(function(item){
        return item.package_name === packageName;
      }).map(function(item){
        return item[fieldName];
      });
    };

    var columns = [
      ["yii2-jcrop"].concat( dataCol("raoul2000/yii2-jcrop-widget", "download")),
      ["yii2-workflow"].concat( dataCol("raoul2000/yii2-workflow", "download")),
      ["yii2-bootswatch-asset"].concat( dataCol("raoul2000/yii2-bootswatch-asset", "download"))
    ];

    return createChart(selector,columns);
  })
  .fail(function(error){
    console.error(error);
    return null;
  });
}
