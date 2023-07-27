@extends('_layouts.app')

@section('content')
{{ $area }}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       <div class="col-sm-1">
        <div class="form-group">
          <label>&nbsp;</label>
          <a href="{{ ('/') }}" class="btn btn-outline-danger btn-block btn-sm"><i class="fa fa-angle-double-left"></i> Back</a>
        </div>
      </div>

      <!-- CHART -->
      <div class="card card-secondary">
        <div class="card-body">
          <div id="chartone"></div>
        </div>
      </div>

      <!-- TABLES -->
      <div class="card card-secondary">
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
              <tr>
                <th>Brand</th>
                <th>Persentase</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($table['data'] as $tb)
              <tr>
                <td>{{$tb['brand_name']}}</td>
                <td>{{$tb['Persentase']}}%</td>
              </tr>    
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


<script>
  $(function() {
    Highcharts.chart('chartone', {
      chart: {
        type: 'column'
      },
      title: {
        align: 'left',
        text: ''
      },
      subtitle: {
        align: 'left'
      },
      accessibility: {
        announceNewData: {
          enabled: true
        }
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {
        title: {
          text: ''
        }

      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y:.1f}%'
          }
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
      },

      series: [
      {
        name: '',
        colorByPoint: false,
        data: <?= $data ?>
      }
      ],
    });

  });
</script>


@endsection