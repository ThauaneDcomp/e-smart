var baseURL = "http://localhost:1026/";

function get(ngsiv2 = 'v2/entities') {
    var ret = $.get(baseURL + ngsiv2, function (date) {//Success
        return date;
    })
        .fail(function () {//error
            return null;
        });

    // showQuery(baseURL + ngsiv2, ret);

    return ret;
}

function post(dataSend) {
    var ret = $.ajax({
      url: baseURL + 'v2/entities/',
      type: 'POST',
      dataType: 'json',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify(dataSend),
      success: function (data) {
        return data;
      },
      error: function(){
        return null;
      }
    });

    // showQuery(baseURL + 'v2/entities/', ret);

    return ret;
}

function deleteFiware(ngsiv2) {
  var ret = $.ajax({
    url: baseURL + ngsiv2,
    type: 'DELETE',
    success: function (data) {
      return data;
    },
    error: function(){
      return null;
    }
  });

  // showQuery(baseURL + ngsiv2, ret);

  return ret;
}

function patch (ngsiv2, dataSend) {
    var ret = $.ajax({
        url: baseURL + ngsiv2,
        type: 'PATCH',
        dataType: 'json',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify(dataSend),
        success: function (data) {
            return data;
        },
        error: function(){
            return null;
        }
    });

    // showQuery(baseURL + ngsiv2, ret);

    return ret;
}

function showQuery(url, response) {
    response.always(function (date) {
        var strDate = '';

        $(date).each(function () {
            strDate = strDate + JSON.stringify(this) + '<br><br>';
        });

        $('#show-query .modal-title').html(
            'URL: ' + url
        );
        $('#show-query .modal-body').html(
            strDate
        );

        $('#show-query').modal({
            show: true
        });
    });
}
