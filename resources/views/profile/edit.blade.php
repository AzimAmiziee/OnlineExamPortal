@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Profile') }}
        </h2>

        <div class="row g-4">
            <!-- Update Profile Info -->
            <div class="col-12 col-md-6">
                <div class="p-4 bg-white shadow rounded">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-12 col-md-6">
                <div class="p-4 bg-white shadow rounded">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="col-12">
                <div class="p-4 bg-white shadow rounded">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection