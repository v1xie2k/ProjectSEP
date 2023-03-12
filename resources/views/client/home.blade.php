@extends('layouts.layout')
@include('navbar')
@section('content')

<!-- buat tulisan didepan -->
<div class="tulisan_depan">
      <div class="judul">
          <center>
          <div class="judul_1"> いらっしゃいませ</div>
          <div class="judul_2">Amazake</div>
          </center>
      </div>
    </div>
    <!-- end tulisan depan -->

    <!-- container sampai era -->
    <div class="container_mid" id="about">
      <!-- panah -->
      <div class="arrow">
        <span></span>
        <span></span>
        <span></span>
      </div>
    <!-- end panah -->

    <!-- buat history -->
    <div class="container_gambar_history">
        <div class="gambar_history">
            <div id="gambarnya">
            </div>
        </div>
        <div class="container_history" style = "padding-top:50px;">
            <div class="kata1">History</div>
            <div class="kata2">of</div>
            <div class="kata3">Amazake</div>
              <br><br>
            <div class="buat_text">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Amazake – where expert culinary skills and an innate appreciation of nature come together to inspire and enhance the Japanese dining experience.

              Since our debut in 2021, we have forged an identity of our own by combining the intricacies of sashimi with teppanyaki to offer the height of Japanese cuisine to the masses.

              Amazake is no ordinary dining restaurant. We believe in providing an alluring ambience that sets us apart from a regular diner.

              Illustrating the emerging influence Asia has on modern Japanese cuisine, our menu features a fusion of traditional Japanese dishes with modern innovative trends. An ever-evolving selection of appetizers, mains and sushi specials will guarantee you a truly authentic Japanese dining experience.
            </div>
        </div>
    </div>
    <!-- end buat history -->

    <!-- buat historical -->
    <br>
    <center>
    <h1 style="font-family: myFt; height: 80px; margin-top: 20px;" class="jir">Our Historical Food</h1>
    </center>
    <!-- dalam historical (card)-->
    <div class="card_container">
        <div class="global_card">
            <div class="card cbg1" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Edo Period</h2>
                    <br>
                    Is the period between 1603 and 1867 in the history of Japan.
                </div>
            </div>
        </div>

        <div class="global_card">
            <div class="card cbg2" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Meiji Period</h2>
                    <br>
                    Is an era of Japanese history that extended from October 23, 1868 to July 30, 1912.
                </div>
            </div>
        </div>

        <div class="global_card">
            <div class="card cbg3" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Taishou Period</h2>
                    <br>
                    Is a period in the history of Japan dating from 30 July 1912 to 25 December 1926.
                </div>
            </div>
        </div>

        <div class="global_card">
            <div class="card cbg4" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Shōwa Period</h2>
                    <br>
                    The Shōwa era refers to the period of Japanese history corresponding to the reign of Emperor Shōwa (Hirohito).
                </div>
            </div>
        </div>
        <div class="global_card">
            <div class="card cbg5" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Heisei Period</h2>
                    <br>
                    Is the period of Japanese history corresponding to the reign of Emperor Akihito.
                </div>
            </div>
        </div>
        <div class="global_card">
            <div class="card cbg6" ></div>
            <div class="bcard" >

                <div class="card_text">
                    <h2>Reiwa Period</h2>
                    <br>
                    Is the current era of Japan's official calendar. It began on 1 May 2019.
                </div>
            </div>
        </div>
    </div>
    <!-- ending card -->
  </div>
  <!-- ending container mid -->

  <!-- awal container low -->
  <div class="container_low" id="low">
    <!-- low kiri  -->
    <div class="low_left">
    <img class="logo" src="{{ asset('css/Assets/logo2.png') }}" alt="" style="width:400px; height:100px;" >
    <p class="buat_text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amazake is a restaurant that serves halal Japanese cuisine and has a taste that suits Indonesian tastes.To be the leading restaurant for quality, value and exceptional service in  all of our outlets worldwide.We are committed to serving good food at affordable prices to our customers.
      We guarantee the freshness of our food and ensure that only top-grade ingredients are used.
        </p>
        <br><br>
        <P style="font-family: myFt;">Thank you our loyal customer</P>
        <br><br>
    </p>
    </div>

    <!-- low tengah -->
    <div class="low_mid">
        <center>
            <h1>Opening Hours</h1>
            <br><br>
            Monday to Friday <br><br>
            08:00 until 15:00 <br>
            16:00 until 21:00 <br><br><br>

            Saturday to Sunday <br><br>
            08:00 until 15:00 <br>
            16:00 until 23:00 <br>
        </center>

    </div>

    <!-- low kanan -->
    <div class="low_right">
        <center>
            <h1>Contact Us</h1>
        </center>
            <br><br>
            <img src="{{ asset('css/Assets/ig.png') }}" alt="">
            &nbsp;&nbsp;&nbsp;Amazake.ig <br>
            <img src="{{ asset('css/Assets/TW.png') }}" alt="">
            &nbsp;&nbsp;&nbsp;Amazake.twt <br>
            <img src="{{ asset('css/Assets/fb.png') }}" alt="">
            &nbsp;&nbsp;&nbsp;Amazake Indonesia <br><br>
            <hr><br>
            <center>
                Contact Person <br>
                Jonathan  +62123123123 <br>
                Kevin S +62123123123 <br>
                Veronica +62123123123 <br>
                Marvell +62123123123 <br>
            </center>
      </div>
  </div>
  <!-- end container low -->
</div>
@endsection

