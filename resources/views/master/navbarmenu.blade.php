<ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
                            @if(auth::user()->level == "admin")
                            <li class=""><a href="/data-produk" class="">Data Produk</a></li>
                            <li class=""><a href="/data-pesanan" class="">Data Pesanan</a></li>
                            <li class="scroll-to-section"><a href="/pelanggan" class="">Data Pelanggan</a></li>
                            
                            @else
                            <li class="scroll-to-section {{ request()->is('pesan') ? 'active' : '' }}"><a href="/pesan" >Pesan MEnu</a>
                            </li>
                            <?php
                                $pesanan = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

                                if(!empty($pesanan)){
                                    $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->count();


                                }else{
                                    $notif = 'belum ada';
                                }
                            ?>

                          
                            
                            <li class="submenu">
                                <a href="javascript:;"><i class="ion-ios-cart "> Riwayat</i></a>
                                <ul>
                                    <li><a href="/cek-out" class="">Pesanan Anda<span class="badge badge-transparent">{{$notif}}</span></a></li>
                                    <li><a href="/struk" class="">detail Pesananmu</a></li>
                                    <li><a href="" class="menu-item">-</a></li>
                                    
                                </ul>
                            </li>
                            @endif
                            <li class=""><a href="/about" class="">About We</a></li>
                            <li>
                                <!-- item-->
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                <button type="submit" class="d-none" id='logout'></button>
                                    <a class="scroll-to-section" style="cursor:pointer;" onclick="$('#logout').click()"><i class="ion-ios-redo" data-pack="ios" data-tags="forward"></i> Logout</a>
                                </form>
                                                                                                            
                            </li>
                        
                            </li>
                          </ul>