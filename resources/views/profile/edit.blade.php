@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            <i class="bi bi-person-circle me-2 text-success"></i>
            My Profile
        </h4>

        <p class="text-muted mb-0">
            Manage your admin account information and password.
        </p>
    </div>

    <div class="row g-4">

        <!-- Profile Information -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    @include('profile.partials.update-profile-information-form')

                </div>
            </div>
        </div>


        <!-- Change Password -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    @include('profile.partials.update-password-form')

                </div>
            </div>
        </div>

    </div>

</div>

@endsection