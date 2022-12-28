$(function () {
  $.ajaxSetup({
    beforeSend: function (jqXHR, Obj) {
      var value = '; ' + document.cookie;
      var parts = value.split('; ym_cookie=');
      if (parts.length == 2) {
        if (Obj.data != undefined) {
          Obj.data += '&ym_token=' + parts.pop().split(';').shift();
        } else {
          Obj.data = 'ym_token=' + parts.pop().split(';').shift();
        }
      }
    },
  });
});

$(document).ready(function () {
  // if($(".select2").length > 0) {
  //     $('.select2').select2();
  // }

  if ($('.monthPicker').length > 0) {
    $('.monthPicker').MonthPicker({ Button: false });
  }

  if ($('#products-sales').length > 0) {
    if (window.prodsale != '') {
      var months = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
      ];
      Morris.Area({
        element: 'products-sales',
        data: JSON.parse(window.prodsale),
        xkey: 'month',
        ykeys: ['shipping'],
        labels: ['Shipping'],
        xLabelFormat: function (x) {
          // <--- x.getMonth() returns valid index
          var month = months[x.getMonth()];
          return month;
        },
        dateFormat: function (x) {
          var month = months[new Date(x).getMonth()];
          return month;
        },
        behaveLikeLine: true,
        resize: true,
        pointSize: 0,
        pointStrokeColors: ['#0bb2d4'],
        smooth: true,
        gridLineColor: '#E4E7ED',
        numLines: 6,
        gridtextSize: 14,
        lineWidth: 0,
        fillOpacity: 0.9,
        hideHover: 'auto',
        lineColors: ['#0bb2d4'],
      });

      Morris.Bar.prototype.fillForSeries = function (i) {
        var color;
        return '0-#fff-#f00:20-#000';
      };
    }
  }

  $(document).on('click', '.modalprofile', function (e) {
    $.each($('#modal-profile').find('input[type=text]'), function (idx, val) {
      $(this).val($(this).attr('data-input'));
    });

    $('#modal-profile').modal('show');
  });

  if ($('.money').length > 0) {
    $('.money').number(true);
  }

  if ($('.moneyfloat').length > 0) {
    $('.moneyfloat').number(true, 2);
  }

  $(document).on('change keydown keyup', '.searchcustomer', function () {
    if ($('.searchcustomer').val() == '') {
      $('.' + $(this).attr('data-name')).val('');
      $('.' + $(this).attr('data-id')).val('');
    }
  });

  window.alltable = {};

  if ($('.table').length > 0) {
    $.each($('.table'), function (idx, val) {
      if (
        $(this).data('content') != '' &&
        typeof $(this).data('content') != 'undefined'
      ) {
        createTable($(this));
      }
    });
  }

  String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
  };

  function createTable(tabledata, showDefaultPage = 10) {
    var columnod = [];
    var columnsort = [];
    var harga = [];
    var tglupdate = [];
    var statusstage = [];
    var monthNamesod = [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sept',
      'Oct',
      'Nov',
      'Dec',
    ];

    var url = tabledata.data('content').split('/');
    var tabledata = tabledata;
    var listtanggal = ['tgl_periksa', 'tgl_upload', 'tgl_soal', 'tgl_perjanjian', 'tgl_survey', 'tgl_input'];

    $.each(tabledata.find('thead > tr:first-child > th'), function (idx, val) {
      var obj = {};
      obj.data = $(this).data('titletb');
      obj.orderable = $(this).data('sort') ? true : false;

      if (listtanggal.includes($(this).data('titletb'))) {
        tglupdate.push(idx);
      }

      columnod.push(obj);
    });

    var tableName = tabledata.attr('id');
    var thistable = tabledata;
    var lastdate = [];

    let bInfo = tabledata.attr('data-hideinfo') ? false : true;
    let bFilter = tabledata.attr('data-hidesearch') ? false : true;
    let lengthChange = tabledata.attr('data-hidepage') ? false : true;
    let maxLength = tabledata.attr('data-max')
      ? tabledata.attr('data-max')
      : showDefaultPage;

    var footCheck = tabledata.find('tfoot').length;
    window.alltable[tableName] = thistable.DataTable({
      responsive: false,
      searchDelay: 1000,
      bFilter: bFilter,
      bInfo: bInfo,
      lengthChange: lengthChange,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
        processing: 'Please wait ...',
      },
      iDisplayLength: maxLength,
      // "sPaginationType": "input",
      processing: true,
      // sDom: '<lfp<"loadingtable"r>tip>',
      serverSide: true,
      bSort: true,
      sAjaxSource: siteUrl + tabledata.data('content'),
      order: columnsort,
      aoColumns: columnod,
      footerCallback: function (row, data, start, end, display) {
        if (footCheck > 0) {
        }
      },
      fnRowCallback: function (nRow, aData, iDisplayIndex) {
        $(nRow)
          .children()
          .each(function (index, td) {
            if ($.inArray(index, tglupdate) !== -1) {
              var original = $(td).text();
              var time = $(td).text().split(' ');
              var tgl = time[0].split('-');

              if (time.length > 1) {
                if (tgl[0] != '0000') {
                  var tgl = time[0].split('-');
                  if (parseInt(tgl[1]) < 10) {
                    $(td).html(
                      '<div class="text-center" data-tanggal="' +
                        original +
                        '">' +
                        tgl[2] +
                        ' ' +
                        monthNamesod[parseInt(tgl[1].replace('0', '')) - 1] +
                        ' ' +
                        tgl[0].toString().substr(2, 2) +
                        ' ' +
                        time[1] +
                        '</div>'
                    );
                  } else {
                    $(td).html(
                      '<div class="text-center" data-tanggal="' +
                        original +
                        '">' +
                        tgl[2] +
                        ' ' +
                        monthNamesod[parseInt(tgl[1]) - 1] +
                        ' ' +
                        tgl[0].toString().substr(2, 2) +
                        ' ' +
                        time[1] +
                        '</div>'
                    );
                  }
                } else {
                  $(td).html('');
                }
              } else {
                if (time[0] != '') {
                  if (tgl[0] != '0000') {
                    var tgl = time[0].split('-');
                    if (parseInt(tgl[1]) < 10) {
                      $(td).html(
                        '<div class="text-center" data-tanggal="' +
                          original +
                          '">' +
                          tgl[2] +
                          ' ' +
                          monthNamesod[parseInt(tgl[1].replace('0', '')) - 1] +
                          ' ' +
                          tgl[0].toString().substr(2, 2) +
                          '</div>'
                      );
                    } else {
                      $(td).html(
                        '<div class="text-center" data-tanggal="' +
                          original +
                          '">' +
                          tgl[2] +
                          ' ' +
                          monthNamesod[parseInt(tgl[1]) - 1] +
                          ' ' +
                          tgl[0].toString().substr(2, 2) +
                          '</div>'
                      );
                    }
                  } else {
                    $(td).html('');
                  }
                }
              }
            }

            if (tableName === 'tabledaftarteshome') {
              if (index === 4) {
                if (parseInt(aData.cek_fisik) === 1) {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-success"></i></div>'
                  );
                } else {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-danger"></i></div>'
                  );
                }
              }

              if (index === 5) {
                if (parseInt(aData.cek_torak) === 1) {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-success"></i></div>'
                  );
                } else {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-danger"></i></div>'
                  );
                }
              }
            }

            if (tableName === 'tabledaftartes') {
              if (index === 7) {
                if (parseInt(aData.cek_fisik) === 1) {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-success"></i></div>'
                  );
                } else {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-danger"></i></div>'
                  );
                }
              }

              if (index === 8) {
                if (parseInt(aData.cek_torak) === 1) {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-success"></i></div>'
                  );
                } else {
                  $(td).html(
                    '<div class="text-center"><i class="fa fa-check-circle text-danger"></i></div>'
                  );
                }
              }

            }

            if (tableName === 'tablesurvey') {
              if (aData.id_user != $("body").attr('data-user')) {
                $(this).closest('tr').find('td').last().find('.remove-record').remove();
              }
            }

              if (tableName === 'tabledaftarcovid') {
                if (index === 7) {
                  if ($(td).text() == 'Rendah') {
                    $(td).addClass('bg-success text-center');
                  }else if ($(td).text() == 'Sedang') {
                    $(td).addClass('bg-warning text-center');
                  }else {
                    $(td).addClass('bg-danger text-center');
                  }
                }
              }
          });
      },
      fnDrawCallback: function (aData) {
        $.fn.tooltip && $('[data-toggle="tooltip"]').tooltip();
      },
      fnServerData: function (sSource, aoData, fnCallback) {
        $.ajax({
          dataType: 'json',
          type: 'POST',
          url: sSource,
          data: aoData,
          success: fnCallback,
        });
      },
    });
  }

  window.createTable = createTable;

  if ($('.datepicker').length > 0) {
    $('.datepicker').datepicker({
      autoclose: true,
      dateFormat: 'dd/mm/yy',
    });
  }

  $(document).on('click', '.remove-record', function (e) {
    e.preventDefault();
    var href = $(this).attr('href');
    var thiselement = $(this);
    var tableid = $(this).closest('table').attr('id');

    if ($('#' + tableid).length > 0) {
      var table = $('#' + tableid).DataTable();
    }

    swal(
      {
        title: 'Anda yakin menghapus data ini ?',
        text: '',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batalkan',
        closeOnConfirm: false,
        closeOnCancel: false,
      },
      function (isConfirm) {
        if (isConfirm) {
          var value = '; ' + document.cookie;
          var parts = value.split('; ym_cookie=');

          $.ajax({
            url: href,
            type: 'POST',
            data: {
              ym_token: parts.pop().split(';').shift(),
            },
            success: function (response) {
              let data = $.parseJSON(response);
              if (response == 1 && !data.error) {
                table.ajax.reload(null, false);
                swal('Deleted!', 'Data berhasil dihapus', 'success');
              } else {
                swal(
                  'Canceled',
                  data.error ? data.error : 'Data gagal dihapus',
                  'error'
                );
              }
            },
          });
        } else {
          swal('Canceled', 'Penghapusan Data Dibatalkan', 'error');
        }
      }
    );
  });
});
