<!-- FOOTER -->
<div class="border-top border-2 border-success">
    <div class="container">
        <footer class="py-5 footer_design">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <a class="mb-2 btn btn-outline-success" href="#">&#8593 &#8593 &#8593</a>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.home') }}"
                                                     class="nav-link p-0 text-muted">Главная</a>
                        </li>
                        <li class="nav-item mb-2"><a class="link-light text-white-50"
                                                     href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => 0]) }}"
                                                     class="nav-link p-0 text-muted">Тренеры</a></li>
                        <li class="nav-item mb-2"><a class="link-light text-white-50"
                                                     href="{{ route('gyms.index', ['city_id' => 0]) }}"
                                                     class="nav-link p-0 text-muted">Фитнес-клубы</a></li>
                        <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.about') }}"
                                                     class="nav-link p-0 text-muted">О проекте</a></li>
                        <li class="nav-item mb-2"><a class="link-light text-white-50"
                                                     href="{{ route('info.contacts') }}" class="nav-link p-0 text-muted">Контакты</a></li>
                        <li class="nav-item mb-2"><a class="link-light text-white-50"
                                                     href="{{ route('info.developers') }}" class="nav-link p-0 text-muted">Разработчики</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 offset-md-1 mb-3">
                    <h5>Подпишитесь на нашу рассылку</h5>
                    <p>Узнайте первым о наших скидках и акциях</p>
                    <form method="post" action="{{ route('subscriptions.store', ['status=1']) }}"
                          class="d-flex flex-column flex-sm-row w-100 gap-2">
                        @csrf
                        <label for="phone_mask" class="visually-hidden">Phone number</label>
                        <input id="phone_mask" type="text" name="phone" class="form-control" placeholder="Телефон">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="email" name="email" class="form-control"
                               placeholder="Электронная почта">
                        <button class="btn btn-outline-success" type="submit">Подписаться</button>
                    </form>
                    <div class="p-2">
                        <p>Укажите номер телефона, чтобы мы убедились, что вы не робот. Рассылка будет приходить только
                            на ваш email.</p>
                    </div>
                    <img class="logo_image" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>&copy; {{ date('Y') }} AggFitness, частное приложение. Все права защищены</p>
            </div>
        </footer>
    </div>
</div>
