@extends('layouts.master', ['title' => 'Kendaraan'])

{{-- Head section to load Leaflet CSS --}}
@section('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-sA+e2xVJH3IT2D7hhmGjG+1bdK2mG2A0U+nYdDgkkZU=" crossorigin="" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
@endsection

{{-- Main content --}}
@section('content')
    <x-container>
        <h1 class="mb-3">Live Vehicle Locations</h1>
        <div id="map"></div>
    </x-container>
@endsection

{{-- Scripts for Leaflet and live updates --}}
@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-o9N1j7kPQoI+w+lN2DWuoHNPxK1QZgZKkAXwWf3vL4w=" crossorigin=""></script>

    <script>
        const map = L.map('map').setView([0, 0], 2); // Default view

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let markers = [];

        async function fetchLocations() {
            try {
                const response = await fetch(`${window.location.origin}/api/latest-locations`);
                if (!response.ok) {
                    throw new Error(`HTTP error: ${response.status}`);
                }

                const data = await response.json();

                // Remove existing markers
                markers.forEach(marker => map.removeLayer(marker));
                markers = [];

                // Add new markers
                data.forEach(location => {
                    if (location.latitude && location.longitude) {
                        const marker = L.marker([location.latitude, location.longitude])
                            .bindPopup(`
                                <strong>ID:</strong> ${location.id}<br>
                                <strong>Name:</strong> ${location.name ?? 'Unknown'}
                            `);
                        marker.addTo(map);
                        markers.push(marker);
                    }
                });

                // Center on the first location if exists
                if (data.length > 0) {
                    map.setView([data[0].latitude, data[0].longitude], 13);
                }

            } catch (error) {
                console.error('Error fetching locations:', error);
            }
        }

        // Initial load and refresh every 5 seconds
        fetchLocations();
        setInterval(fetchLocations, 5000);
    </script>
@endsection