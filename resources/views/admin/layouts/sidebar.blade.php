<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="#7367F0" />
                  <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616" />
                  <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616" />
                  <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="#7367F0" />
                </svg>
              </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ config('settings.site_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Kontrol Paneli">Kontrol Paneli</div>
            </a>
        </li>

        <!-- Menu -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Yönetim Paneli</span>
        </li>
        <!-- Slayt -->
        <li class="menu-item">
            <a href="{{ route('admin.slider.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layers-subtract"></i>
                <div data-i18n="Slayt Ayarları">Slayt Ayarları</div></a>
        </li>

        <!-- Restaurant Menu -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-home-cog"></i>
                <div data-i18n="Restoranı Yönet">Restoranı Yönet</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <div data-i18n="Ürün Kategorileri">Ürün Kategorileri</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.product.index') }}" class="menu-link">
                        <div data-i18n="Ürünler">Ürünler</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Order Menu -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-bag"></i>
                <div data-i18n="Siparişler">Siparişler</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        <div data-i18n="Tüm Siparişler">Tüm Siparişler</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.pending-orders') }}" class="menu-link">
                        <div data-i18n="Bekleyen Siparişler">Bekleyen Siparişler</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.inprocess-orders') }}" class="menu-link">
                        <div data-i18n="Devam Eden Siparişler">Devam Eden Siparişler</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.delivered-orders') }}" class="menu-link">
                        <div data-i18n="Teslim Edilen Siparişler">Teslim Edilen Siparişler</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.declined-orders') }}" class="menu-link">
                        <div data-i18n="İptal Edilen Siparişler">İptal Edilen Siparişler</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ECommerce Menu -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-bag"></i>
                <div data-i18n="E-Ticareti Yönet">E-Ticareti Yönet</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.coupon.index') }}" class="menu-link">
                        <div data-i18n="Kuponlar">Kuponlar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.delivery-area.index') }}" class="menu-link">
                        <div data-i18n="Teslimat Alanları">Teslimat Alanları</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.payment-setting.index') }}" class="menu-link">
                        <div data-i18n="Ödeme Yöntemleri">Ödeme Yöntemleri</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Messages -->
        <li class="menu-item">
            <a href="{{ route('admin.chat.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-message"></i>
                <div data-i18n="Mesajlar">Mesajlar</div></a>
        </li>

        <!-- Setting Page -->
        <li class="menu-item">
            <a href="{{ route('admin.setting.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings-2"></i>
                <div data-i18n="Site Ayarları">Site Ayarları</div></a>
        </li>


        <!-- Misc -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Diğer</span>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
