@extends('layouts.master')
@section('title', 'Dashboard')
@section('li-dashboard', 'active')
@section('content')
<div class="row mb-3">
  <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Article</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalarticles }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-newspaper fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Categories</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalcategories }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tag fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalauthor }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection