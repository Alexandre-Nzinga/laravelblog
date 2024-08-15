@extends('layouts/user-layout')
    @section('space-work')
        <div class="container">
            <livewire:guest-profile-view :guestId="$guest_id" />
        </div>
    @endsection
