@extends('_layouts.app')

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">        
        <div class="card card-secondary">
          <div class="card-body">
            <form method="POST" action="{{ route('searchdata') }}">
              @csrf
              <div class="row">
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Select Area</label>
                    <select class="form-control form-control-sm" name="area" required>
                      <option value=""> -- </option>
                      @foreach ($area['data'] as $dt)
                      <option value="{{$dt['area_id']}}">{{$dt['area_name']}}</option>     
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>Date From</label>
                    <div class="input-group date" id="reservationdatestart" data-target-input="nearest">
                      <input name="datestart" type="text" class="form-control form-control-sm datetimepicker-input" />
                      <div class="input-group-append" data-target="#reservationdatestart" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>Date To</label>
                    <div class="input-group date" id="reservationdatefinish" data-target-input="nearest">
                      <input name="datefinish" type="text" class="form-control form-control-sm datetimepicker-input" />
                      <div class="input-group-append" data-target="#reservationdatefinish" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-block bg-gradient-primary btn-sm">Search</button>
                  </div>
                </div>
              </div>
            </form>
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
                  <th>BRAND</th>
                  <th>DKI Jakarta</th>
                  <th>Jawa Barat</th>
                  <th>Kalimantan</th>
                  <th>Jawa Tengah</th>
                  <th>Bali</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($table['data'] as $tb)
                <tr>
                  <td>{{$tb['brand_name']}}</td>
                  <td>{{$tb['jakarta']}}%</td>
                  <td>{{$tb['jawabarat']}}%</td>
                  <td>{{$tb['kalimantan']}}%</td>
                  <td>{{$tb['jawatengah']}}%</td>
                  <td>{{$tb['bali']}}%</td>
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