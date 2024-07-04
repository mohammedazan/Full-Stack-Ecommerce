<!-- Conteneur de la barre latérale -->
<div class="sidebar-wrapper" data-simplebar="true">

    <div class="sidebar-header d-flex justify-content-center">
        <div>
            <img src="{{asset('assets/adminPanel')}}/images/Forbest-Logo-01.png" alt="Forbest "  class="logo-text" width="130px">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>

    <!-- Navigation -->
    <ul class="metismenu" id="menu">
        
       {{--  <li>
            <a href="{{route('admin.pos.view')}}">

                <div class="menu-title">
                    <spna class="add-menu-sidebar"
                          style="display: flex;justify-content: center;align-items: center" data-toggle="modal"
                          data-target="#addOrderModalside">
                        <i class="fa fa-plus"></i>
                        <span class="nav-text text-center text-white"><i class="lni lni-circle-plus"></i>POS</span>
                    </spna>
                </div>
            </a>


        </li> --}}

        {{--        <li class="menu-label">Éléments d'interface utilisateur</li>--}}
        <li>
            <a href="{{route('home')}}">
                <div class="parent-icon" style="color: #2ECC71;"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        @if(userCanAccess('h1'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-list"></i>
                    </div>
                    <div class="menu-title">Admin Role</div>
                </a>
                
                <ul>
                    @if(userCanAccess('1'))
                        <li>
                            <a href="{{route('admin.role.create')}}"><i class="bx bx-right-arrow-alt"></i>Role</a>
                        </li>
                    @endif
                    @if (userCanAccess('m1'))
                        <li>
                            <a href="{{route('admin.role.list')}}"><i class="bx bx-right-arrow-alt"></i>List Role</a>
                        </li>
                    @endif 
                    @if (userCanAccess('m2'))
                        <li>
                            <a href="{{route('admin.user.list')}}"><i class="bx bx-right-arrow-alt"></i>List Users</a>
                        </li>
                    @endif   
                    @if(userCanAccess('2'))
                        <li>
                            <a href="{{route('admin.admin.create')}}"><i class="bx bx-right-arrow-alt"></i>Create Admin</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        {{-- @if(userCanAccess('invisible'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cart"></i>
                    </div>
                    <div class="menu-title">POS</div>
                </a>
                <ul>
                    @if(userCanAccess('3'))
                        <li>
                            <a href="{{route('admin.pos.view')}}"><i class="bx bx-right-arrow-alt"></i>POS</a>
                        </li>
                    @endif
                    @if(userCanAccess('4'))
                        <li>
                            <a href="{{route('sell.list')}}"><i class="bx bx-right-arrow-alt"></i>Liste de vente</a>
                        </li>
                    @endif
                    @if(userCanAccess('m3'))
                    <li>
                        <a href="{{route('admin.pos.customer.list')}}"><i class="bx bx-right-arrow-alt"></i>Liste des clients POS</a>
                    </li>
                    @endif


                </ul>
            </li>
        @endif --}}
        @if(userCanAccess('h3'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-producthunt"></i>
                    </div>
                    <div class="menu-title">Product </div>
                </a>
                <ul>
                    @if(userCanAccess('8'))
                        <li>
                            <a href="{{route('admin.product.list')}}"><i class="bx bx-right-arrow-alt"></i>Products List</a>
                        </li>
                    @endif
                    
                    @if(userCanAccess('5'))
                        <li><a href="{{route('admin.create.product')}}"><i class="bx bx-right-arrow-alt"></i>Add

                            Products</a>
                        </li>
                    @endif
                    @if(userCanAccess('6'))
                        <li><a href="{{route('admin.product.category')}}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                        </li>
                    @endif
                    @if(userCanAccess('7'))
                        <li>
                            <a href="{{route('admin.product.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Subcategory</a>
                        </li>
                    @endif
                        </li>
                    @if(userCanAccess('m4'))
                        <li>
                            <a href="{{route('admin.product.color.show')}}"><i class="bx bx-right-arrow-alt"></i>Couleur du produit</a>
                        </li>
                    @endif

                    {{-- @if(userCanAccess('m5'))
                        <li>
                            <a href="{{route('admin.product.size.show')}}"><i class="bx bx-right-arrow-alt"></i>Taille du produit</a>
                        </li>
                    @endif     --}}

                    @if(userCanAccess('m6'))
                        <li>
                            <a href="{{route('admin.product.brand')}}"><i class="bx bx-right-arrow-alt"></i>Product
                                Brand</a>
                        </li>
                    @endif    
                </ul>
            </li>
        @endif
        
        {{-- @if(userCanAccess('h8'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-producthunt"></i>
                    </div>
                    <div class="menu-title">Commande</div>
                </a>
                <ul>
                                   <li>
                                       <a href="{{route('admin.order.all')}}"><i class="bx bx-right-arrow-alt"></i>Toutes les commandes</a>
                                   </li>
                    @if(userCanAccess('15'))
                        <li>
                            <a href="{{route('admin.order.pending')}}"><i class="bx bx-right-arrow-alt"></i>Commande en attente</a>
                        </li>
                    @endif
                    @if(userCanAccess('16'))
                        <li>
                            <a href="{{route('admin.order.processing')}}"><i class="bx bx-right-arrow-alt"></i>Commande en traitement</a>
                        </li>
                    @endif
                    @if(userCanAccess('17'))
                        <li>
                            <a href="{{route('admin.order.on-the-way')}}"><i class="bx bx-right-arrow-alt"></i>Commande en cours de livraison</a>
                        </li>
                    @endif
                    @if(userCanAccess('18'))
                        <li><a href="{{route('admin.order.cancel.request')}}"><i class="bx bx-right-arrow-alt"></i>Demande d'annulation de commande</a>
                        </li>
                    @endif
                    @if(userCanAccess('19'))
                        <li><a href="{{route('admin.order.cancel.accept')}}"><i class="bx bx-right-arrow-alt"></i>Accepter l'annulation de commande</a>
                        </li>
                    @endif
                    @if(userCanAccess('20'))
                        <li><a href="{{route('admin.order.cancel.completed')}}"><i class="bx bx-right-arrow-alt"></i>Annulation terminée</a></li>
                    @endif
                    @if(userCanAccess('21'))
                        <li><a href="{{route('admin.order.completed')}}"><i class="bx bx-right-arrow-alt"></i>Commande terminée</a>
                        </li>
                    @endif
                </ul>

            </li>
        @endif --}}

        @if(userCanAccess('Co1'))
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-cart"></i></div>
        <div class="menu-title">Order</div>
    </a>
    <ul>
         @if(userCanAccess('Co2'))
        <li>
            <a href="{{ route('order_in_the_cart') }}"><i class="bx bx-right-arrow-alt"></i>  Order </a>
        </li>

    
        @endif


        @if(userCanAccess('Co3'))
        <li>
            <a href="{{ route('en_cours') }}"><i class="bx bx-right-arrow-alt"></i> commande en cours </a>
        </li>

    
        @endif
    </ul>
</li>
@endif

        @if(userCanAccess('h4'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-package"></i>
                    </div>
                    <div class="menu-title">Supplier</div>
                </a>
                <ul>
                    {{-- @if(userCanAccess('9'))
                        <li>
                            <a href="{{route('admin.product.purchase')}}"><i class="bx bx-right-arrow-alt"></i>Achat
                                de produit</a>
                        </li>
                    @endif --}}
                    {{-- <li>
                        <a href="{{route('admin.product.purchase.list')}}"><i class="bx bx-right-arrow-alt"></i>Liste
                            d'achat
                        </a>
                    </li> --}}


                    @if(userCanAccess('9'))
                    <li>
                        <a href="{{route('admin.supplier.list')}}"><i class="bx bx-right-arrow-alt"></i>Supplier
                            List</a>
                    </li>
                     @endif
                </ul>
            </li>
        @endif
        @if(userCanAccess('h5'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-offer"></i>
                    </div>
                    <div class="menu-title">Offer Setting </div>
                </a>
                <ul>
                    @if(userCanAccess('10'))
                        <li>
                            <a href="{{route('offer.list')}}"><i class="bx bx-right-arrow-alt"></i>Create Offer</a>
                        </li>
                    @endif
                {{-- <li>
                    <a href="{{route('admin.set.offer.product')}}"><i class="bx bx-right-arrow-alt"></i>Sélectionner le produit de l'offre</a>
                </li> --}}
                    @if(userCanAccess('11'))
                        <li>
                            <a href="{{route('admin.offer.product.list')}}"><i class="bx bx-right-arrow-alt"></i>Offer
                                Product</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
        @if(userCanAccess('ne1'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon" style="color: #2ECC71;">
                    <i class="lni lni-envelope"></i> <!-- Icône Newsletter de LineIcons -->
                </div>
                <div class="menu-title">Newsletter</div>
            </a>
            <ul>
                @if(userCanAccess('ne2'))
                <li>
                    <a href="{{ route('list.subscribe') }}">
                        <i class="bx bx-right-arrow-alt"></i> <!-- Icône de flèche droite de Boxicons -->
                        List subscribers
                    </a>
                </li>
                @endif
            </ul>
        </li>
    @endif
    
        @if(userCanAccess('h6'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-cog" style="color: #2ECC71;"></i></div>
                    <div class="menu-title">Setting</div>
                </a>
                <ul>
                    @if(userCanAccess('12'))
                        <li>
                            <a href="{{route('setting.company.details')}}"><i class="bx bx-right-arrow-alt"></i>Company
                                Details</a>
                        </li>
                    @endif
                    {{-- @if(userCanAccess('12'))
                        <li>
                            <a href="{{route('setting.shipping.rate')}}"><i class="bx bx-right-arrow-alt"></i>Tarif d'expédition</a>
                        </li>
                    @endif --}}
                    @if(userCanAccess('m7'))
                        <li>
                            <a href="{{route('faq.view')}}"><i class="bx bx-right-arrow-alt"></i>FAQ Set</a>
                        </li>
                    @endif
                    @if(userCanAccess('m8'))
                        <li>
                            <a href="{{route('ads.view')}}"><i class="bx bx-right-arrow-alt"></i>Ads Set</a>
                        </li>
                    @endif    

                </ul>
            </li>
        @endif


        @if(userCanAccess('m9'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-star"></i></div>
                <div class="menu-title">Featured Link</div>
            </a>
            <ul>
                 @if(userCanAccess('m10'))
                <li>
                    <a href="{{route('admin.featured.link.list')}}"><i class="bx bx-right-arrow-alt"></i> Featured Link
                        List  </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

 @if(userCanAccess('m9'))
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-pencil"></i></div>
        <div class="menu-title">Blogs</div>
    </a>
    <ul>
         @if(userCanAccess('m10'))
        <li>
            <a href="{{ route('blogs') }}"><i class="bx bx-right-arrow-alt"></i> Blog List </a>
        </li>
        @endif
    </ul>
</li>
@endif




        @if(userCanAccess('m9'))
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon" style="color: #2ECC71;"><i class="fas fa-comment"></i></div>
        <div class="menu-title">Product Reviews</div>
    </a>
    <ul>
         @if(userCanAccess('m10'))
        <li>
            <a href="{{ route('reviews') }}"><i class="bx bx-right-arrow-alt"></i> Reviews List </a>
        </li>
        @endif
    </ul>
</li>
@endif

        {{-- @if(userCanAccess('h7'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-home"></i>
                    </div>
                    <div class="menu-title">Banque</div>
                </a>
                <ul>
                    @if(userCanAccess('14'))
                    <li>
                        <a href="{{route('admin.bank.list')}}"><i class="bx bx-right-arrow-alt"></i>Liste des banques</a>
                    </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(userCanAccess('h9'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon" style="color: #2ECC71;"><i class="lni lni-stats-up"></i>
                    </div>
                    <div class="menu-title">Rapport</div>
                </a>
                <ul>
                    @if(userCanAccess('23'))
                        <li>
                            <a href="{{route('admin.report.sell.profit')}}"><i class="bx bx-right-arrow-alt"></i>Rapport de vente et de profit</a>
                        </li>
                    @endif
                    @if(userCanAccess('22'))
                        <li>
                            <a href="{{route('admin.report.sell')}}"><i class="bx bx-right-arrow-alt"></i>Meilleur rapport de vente de produits</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif --}}

    </ul>
    <!-- Fin de la navigation -->
</div>
<!-- Fin du conteneur de la barre latérale -->
