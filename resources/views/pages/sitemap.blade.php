@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Application Sitemap</h2>
    <hr>
    <ul>
        <li><strong>Public Pages</strong>
            <ul>
                <li><a href="{{ route('home') }}">Home Page (News & Info)</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="/login">Login</a> / <a href="/register">Register</a></li>
            </ul>
        </li>
        <li><strong>Patient Module</strong>
            <ul><li>Dashboard</li><li>Search Doctor & Book Appointment</li></ul>
        </li>
        <li><strong>Doctor Module</strong>
            <ul><li>Dashboard (Pending Appointments)</li><li>Manage Schedules</li></ul>
        </li>
        <li><strong>Administrator Module</strong>
            <ul><li><a href="{{ route('admin.dashboard') }}">Admin Dashboard (City & Content Management)</a></li></ul>
        </li>
    </ul>
</div>
@endsection