@extends('layout.main')

@push('link')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="module" src="{{ asset('assets/js/index.js') }}"></script>
@endpush

@section('content')
<div class="container h-100">

    <section id="profile" class="pt-4 pb-5">
        <h1 class="fw-semibold fs-40 text-navysky mb-4">{{ $title }}</h1>

        <div id="map"></div>
        <div id="sidebar">
            <h3 style="flex-grow: 0">Request</h3>
            <pre style="flex-grow: 1" id="request"></pre>
            <h3 style="flex-grow: 0">Response</h3>
            <pre style="flex-grow: 1" id="response"></pre>
        </div>

        <div id="text"></div>
    </section>

</div>

<style>
    /**
    * @license
    * Copyright 2019 Google LLC. All Rights Reserved.
    * SPDX-License-Identifier: Apache-2.0
    */
    /*
    * Always set the map height explicitly to define the size of the div element
    * that contains the map.
    */
    #map {
        height: 500px;
        width: 100%;
    }

    /*
    * Optional: Makes the sample page fill the window.
    */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #sidebar {
        flex-basis: 15rem;
        flex-grow: 1;
        padding: 1rem;
        max-width: 30rem;
        height: 100%;
        box-sizing: border-box;
        overflow: auto;
    }

    #map {
        /* flex-basis: 0;
        flex-grow: 4;
        height: 100%; */
    }

    #sidebar {
        flex-direction: column;
    }
</style>
@endsection

@push('script')
{{-- <script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "AIzaSyCuN63dkeBKLJH8vS5hjLt8zRUHo9Ye3kw", v: "weekly"});
</script> --}}
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuN63dkeBKLJH8vS5hjLt8zRUHo9Ye3kw&callback=initMap&v=weekly">
</script>
@endpush
