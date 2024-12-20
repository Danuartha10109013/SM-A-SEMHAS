@extends('L-08.layout.main')
@section('title')
    Packing L-08 ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Packing L-08
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      @if (Auth::user()->role == 0)
      <a href="{{ route('L-08.admin.damage.add') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> New Coil</a>
      @else
      <a href="{{ route('L-08.pegawai.damage.add') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> New Coil</a>
      @endif
  
      <!-- Export Form -->
      @if (Auth::user()->role == 0)
      <form action="{{ route('L-08.admin.damage.export') }}" method="GET" class="mb-3">
      @else
      <form action="{{ route('L-08.pegawai.damage.export') }}" method="GET" class="mb-3">
      @endif

          @csrf
  
          <!-- Include the current filter values -->
          <input type="hidden" name="year" value="{{ $selectedYear }}">
          <input type="hidden" name="month" value="{{ $selectedMonth }}">
          <input type="hidden" name="search" value="{{ $search }}">
  
          <button type="submit" class="btn btn-success mb-3">
              <i class="mdi mdi-export"></i> Export
          </button>
      </form>
    
<div class="row">
  <div class="col-md-7">
    <!-- Year Filter Form -->
    <!-- Year Filter Form -->
    @if (Auth::user()->role == 0)
    <form action="{{ route('L-08.admin.dashboard') }}" method="GET">
    @else
    <form action="{{ route('L-08.pegawai.dashboard') }}" method="GET">
    @endif
        <select name="year" id="year" onchange="this.form.submit()" class="form-select">
            @foreach($years as $year)
                <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                    {{ $year->year }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <input type="hidden" name="search" value="{{ $search }}">
    </form>

    <!-- Month Filter Form -->
    @if (Auth::user()->role == 0)
    <form action="{{ route('L-08.admin.dashboard') }}" method="GET">
    @else
    <form action="{{ route('L-08.pegawai.dashboard') }}" method="GET">
    @endif
        <select name="month" id="month" onchange="this.form.submit()" class="form-select mt-2">
            <option value="">-- Select Month --</option>
            @foreach(range(1, 12) as $month)
                <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="search" value="{{ $search }}">
    </form>

    
  </div>
  <div class="col-md-5 text-end">
    <!-- Search Form -->
    <form action="{{ route('L-08.admin.dashboard') }}" method="GET" class="d-inline">
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" value="{{ $search }}" style="width: auto;background-color: white">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
  </div>
</div>

    
@if (Auth::user()->role == 0)
    
    <!-- Bar Chart for Coil Damage -->
    <div class="card mt-4 mb-4">
      <center><p class="fw-bold mt-2">All Packing List</p></center>
        <div class="card-body">
            <canvas id="coilDamageChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for Chart.js
        const data = @json($chart);
        const labels = [];
        const damageCounts = [];

        data.forEach(item => {
            // If month filter is selected, show daily data
            if (item.day) {
                labels.push(`Day ${item.day}`);
                damageCounts.push(item.total);
            }
            // If month filter is not selected, show monthly data
            else {
                const monthName = new Date(item.month + '-01').toLocaleString('default', { month: 'long' });
                labels.push(monthName);
                damageCounts.push(Math.round(item.total));
            }
        });

        // Render the bar chart
        const ctx = document.getElementById('coilDamageChart').getContext('2d');
        const coilDamageChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Packing Count',
                    data: damageCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Ensures the chart resizes based on the container
                maintainAspectRatio: false, // Allows flexible resizing of the chart
                animations: {
                    tension: {
                        duration: 0 // Disables animation on bar chart tension
                    },
                    x: {
                        duration: 0 // Disables animation for x-axis
                    },
                    y: {
                        duration: 0 // Disables animation for y-axis
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ $selectedMonth ? "Day" : "Month" }}'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Packing Count'
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 mb-4">
                <center>
                    <p class="fw-bold mt-2">Tren By Group</p>
                </center>
                <div class="card-body">
                    <div class="col-md-12">
                        <canvas id="packingChart"></canvas>
                    </div>
                </div>
            </div>
            <script>
                // Pass chart data from the controller to the view
                const chartData = @json($chartData);
                console.log(chartData); // Debug chart data
            
                // Prepare data for Chart.js for the "packingChart"
                const monthLabels = Object.keys(chartData); // Use a different name for labels
                console.log(monthLabels); // Debug labels for months
                const packingDatasets = []; // Use a different name for datasets
                const colors = ['#FF5733', '#33FF57', '#3357FF', '#F3FF33', '#FF33A1'];
            
                // Collect unique groups across all months
                const groups = [...new Set(Object.values(chartData).flatMap(monthData => Object.keys(monthData)))];
                console.log(groups); // Debug groups
            
                groups.forEach((group, index) => {
                    packingDatasets.push({
                        label: `Group ${group}`,
                        data: monthLabels.map(month => chartData[month][group] || 0),
                        backgroundColor: colors[index % colors.length],
                        borderColor: colors[index % colors.length],
                        borderWidth: 1,
                        barPercentage: 1, // Make bars occupy full space (no gap)
                        categoryPercentage: 1 // Make bars for each category (month) touch each other
                    });
                });
                console.log(packingDatasets); // Debug datasets for packing chart
            
                // Use a different variable name for the canvas context to avoid conflicts
                const packingChartCtx = document.getElementById('packingChart')?.getContext('2d');
                if (packingChartCtx) {
                    new Chart(packingChartCtx, {
                        type: 'bar',
                        data: {
                            labels: monthLabels,
                            datasets: packingDatasets,
                        },
                        options: {
                            responsive: true, // Enable responsiveness
                            maintainAspectRatio: false, // Disable aspect ratio maintenance
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Attribute Counts by Group and Month'
                                }
                            },
                            scales: {
                                x: {
                                    stacked: false, // Ensure the bars are not stacked
                                    title: {
                                        display: true,
                                        text: 'Months'
                                    },
                                    barThickness: 30, // Adjust bar thickness if needed
                                },
                                y: {
                                    stacked: false, // Ensure the y-axis is not stacked
                                    title: {
                                        display: true,
                                        text: 'Attribute Count'
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.error("Canvas element not found!");
                }
            </script>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-12">
            <form id="filterForm" action="{{ route('L-08.admin.dashboard') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="date" id="startDate" style="background-color: white" name="start_date" value="{{$startDate}}" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label for="endDate" class="form-label">End Date:</label>
                        <input type="date" id="endDate" name="end_date" style="background-color: white" value="{{$endDate}}" class="form-control" />
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" id="filterButton" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Chart Section -->
        <div class="col-md-12">
            <div class="card mt-4 mb-4">
                <center>
                    <p class="fw-bold mt-2">Tren Today</p>
                </center>
                <div class="card-body">
                    <div class="col-md-12">
                        <canvas id="packingChartToday"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Pass chart data from the controller to the view
        let chartDataToday = @json($chartDataToday); // Data for Tren Today
        console.log(chartDataToday); // Debug chart data today

        // Prepare data for Chart.js
        const todayLabels = Object.keys(chartDataToday);
        const todayDatasets = [];
        const colorsToday = ['#FF5733', '#33FF57', '#3357FF', '#F3FF33', '#FF33A1'];

        // Collect unique groups for Tren Today
        const groupsToday = [...new Set(Object.values(chartDataToday).flatMap(dateData => Object.keys(dateData)))];

        groupsToday.forEach((group, index) => {
            todayDatasets.push({
                label: `Group ${group}`,
                data: todayLabels.map(date => chartDataToday[date][group] || 0),
                backgroundColor: colorsToday[index % colorsToday.length],
                borderColor: colorsToday[index % colorsToday.length],
                borderWidth: 1,
            });
        });

        // Create the chart for Tren Today
        const todayChartCtx = document.getElementById('packingChartToday')?.getContext('2d');
        const todayChart = new Chart(todayChartCtx, {
            type: 'bar',
            data: {
                labels: todayLabels,
                datasets: todayDatasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Attribute Counts for Today (Filtered by Date)',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dates',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Attribute Count',
                        },
                    },
                },
            },
        });
    </script>
@endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <div class="card mt-4">
        <div class="card-header">Data Detail</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Attribute</th>
                  <th>Kondisi Coil</th>
                  <th>Group</th>
                  <th>Layout Kontainer</th>
                  <th>No Sales Order</th>
                  <th>Responden</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  
                <tr>
                  <td class="align-middle text-start">{{$loop->iteration}}</td>
                  <td class="align-middle text-start">{{ $d->created_at->format('d-m-Y')}}</td>

                  <td class="align-middle text-start">{{$d->attribute}}</td>
                  <td class="align-middle text-start">{{$d->kondisi}}</td>
                  <td class="align-middle text-start">{{$d->group}}</td>
                  <td class="align-middle">{{$d->layout_kontainer}}</td>
                
                  <td class="align-middle text-start">{{$d->no_sales}}</td>
                  <td class="align-middle text-start">
                    @php
                      $name = \App\Models\User::where('id',$d->user_id)->value('name');
                    @endphp
                    {{$name}}
                  </td>
                  <td class="align-middle text-start">
                    
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $d->id }}">
                      <i class="fa fa-trash"></i> 
                  </a>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $d->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            @if (Auth::user()->role == 0)
                              <form action="{{route('L-08.admin.damage.delete',$d->id)}}" method="POST">
                            @else
                              <form action="{{route('L-08.pegawai.damage.delete',$d->id)}}" method="POST">
                            @endif
                                  @csrf
                                  @method('DELETE')
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel-{{ $d->id }}">Delete d</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete this?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>

                    

                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          
        </div>
      </div>

      
    </div>
    


    </div>
</div>
@endsection