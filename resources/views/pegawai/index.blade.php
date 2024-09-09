@extends('layout.pegawai.main')
@section('title')
Dashboard || Pegawai 
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                     <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>352</h2>
                            <p class="fontsize-sm m-0">Total Shipp</p>
                        </div>
                        <div class="rounded-circle iq-card-icon dark-icon-light iq-bg-primary "> <i class="ri-inbox-fill"></i></div>
                     </div>
             </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                       <h2>$37k</h2>
                       <p class="fontsize-sm m-0">Shippment A</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-danger"><i class="ri-radar-line"></i></div>
                </div>
              </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                       <h2>32%</h2>
                       <p class="fontsize-sm m-0">Shippment B</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-warning "><i class="ri-price-tag-3-line"></i></div>
                </div>
            </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                       <h2>27h</h2>
                       <p class="fontsize-sm m-0">Payment</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-refund-line"></i></div>
                </div>
            </div>
          </div>
       </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-a')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                          <h2>Shippment A</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type A</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-b')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                          <h2>Shippment B</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type B</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
   
</div>
@endsection
 