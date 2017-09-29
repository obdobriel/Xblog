<div class="card card-user mb-3" style="overflow: hidden">
    <?php
    if (isset($profile_image) && $profile_image)
        $style = "background: url($profile_image) no-repeat center center;background-size: cover";
    else
        $style = '';
    ?>
    <div class="card-user-header bg-placeholder" style="{{ $style }}">
        <h3 class="card-user-username">{{ $author or 'Gabriel' }}</h3>
        <h5 class="card-user-desc">{{ $description or 'coding keep moving' }}</h5>
    </div>
    <div class="card-user-image">
        <img class="rounded-circle"
             src="{{ $avatar or 'http://ox124gnrs.bkt.clouddn.com/image/JXs0wdHwyVgZPy3WpYepcZEvS1soiumWj4OOy5dv.jpeg' }}"
             alt="User Avatar">
    </div>
    <div class="card-user-footer">
        <div class="row">
            <?php $count = count(config('social'))?>
            @foreach(config('social') as $key => $value)
                <div class="col border-right center-block">
                    <div class="description-block">
                        <a href="{{ $value['url'] }}" title="{{ ucfirst($key) }}" class="description-header"><i class="{{ 'fa fa-'.$value['icon'].' fa-lg' }}"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>