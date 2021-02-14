<div class="sidebar" data-color="white" data-active-color="primary">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="{{ asset('paper') }}/img/logo-small.png">
                </div>
            </a>
            <a href="#" class="simple-text logo-normal">
                {{ __('ASCA') }}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ $elementActive == 'user' || $elementActive == 'tache-index' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                        <i class="nc-icon nc-vector"></i>
                        <p>
                                {{ __('Les Taches') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExamples">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'tache-index' ? 'active' : '' }}">
                                <a href="{{ route('tache.index') }}">
                                    <span class="sidebar-mini-icon">{{ __('T') }}</span>
                                    <span class="sidebar-normal">{{ __(' Les taches recentes ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'mt' ? 'active' : '' }}">
                                <a href="{{ route('mes-tache') }}">
                                    <span class="sidebar-mini-icon">{{ __('MT') }}</span>
                                    <span class="sidebar-normal">{{ __(' Mes Taches ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
