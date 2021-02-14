<div class="sidebar" data-color="white" data-active-color="primary">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="{{ asset('paper') }}/img/logo-small.png">
                </div>
            </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                {{ __('ASCA') }}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('page.index', 'dashboard') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('DEMO') }}</p>
                    </a>
                </li>
                    <li class="{{ $elementActive == 'user' || $elementActive == 'tache-admin' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="false" href="#tasks">
                                <i class="nc-icon"><img src="{{ asset('paper/img/task-list.svg') }}"></i>
                                <p>
                                        {{ __('Les taches') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="tasks">
                                <ul class="nav">
                                        <li class="{{ $elementActive == 'tache-admin' ? 'active' : '' }}">
                                <a href="{{ route('list-tache') }}">
                                    <i class="nc-icon nc-vector"></i>
                                    <p>{{ __('Les taches') }}</p>
                                </a>
                        </li>
                        <li class="{{ $elementActive == 'mt' ? 'active' : '' }}">
                                <a href="{{ route('mes-tache') }}">
                                    <i class="nc-icon nc-bullet-list-67"></i>
                                    <p>{{ __('Mes taches') }}</p>
                                </a>
                            </li>
                        <li class="{{ $elementActive == 'tache-index' ? 'active' : '' }}">
                                <a href="{{ route('tache.index') }}">
                                    <i class="nc-icon"><img src="{{ asset('paper/img/task-recent.svg') }}"></i>
                                    <p>{{ __('Les taches recentes') }}</p>
                                </a>
                            </li>
                                </ul>
                            </div>
                        </li>
                <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="false" href="#laravelExamples">
                        <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                        <p>
                                {{ __('Utilisateurs') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="laravelExamples">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                                <a href="{{ route('profile.edit') }}">
                                    <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                    <span class="sidebar-normal">{{ __(' Mon Profile ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                                <a href="{{ route('page.index', 'user') }}">
                                    <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                    <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
