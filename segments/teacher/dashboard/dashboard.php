<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">User Count</div>
                        <div class="stat-digit"><?= User::userCount()[0] ?></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-book text-primary border-primary"></i></div>
                    <div class="stat-content dib">
                        <div class="stat-text">Course Count</div>
                        <div class="stat-digit"><?= Course::getCourseCount($user->getID()) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>