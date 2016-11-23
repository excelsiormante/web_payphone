    
    @extends('layouts.app-layout')
    @section('content')
        
    @include('modals.confirm_plan')
    @include('modals.add_speed_dial')
    @include('modals.payment')
    @include('modals.paypercall')

    <header id="top" class="header">

        <section id="tab_subscribe" class="section">

                @include('tabs.subscribe')
        </section>


        <section id="tab_selectplan" class="section">

                @include('tabs.selectplan')
        </section>

        <section id="tab_dialer" class="section">

                @include('tabs.dialer')
        </section>

        <section id="tab_call" class="section">

                @include('tabs.call')
        </section>

        <section id="tab_ewallet" class="section">

                @include('tabs.ewallet')

        </section>

         
    </header>

    <div class="overlay">
        <div class="centered-loading">
        <div class="cssload-loader"><div class="cssload-inner cssload-one"></div><div class="cssload-inner cssload-two"></div><div class="cssload-inner cssload-three"></div></div>
        </div>
    </div>
    <div class="dark-fade"></div>

    @endsection
   
   