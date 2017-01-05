<!-- Scripts -->
<script src="../../res/layui/layui.js?t={{str_random(10)}}"></script>
@if(\Illuminate\Support\Facades\Auth::check())
    <?php $user=\Illuminate\Support\Facades\Auth::user()  ?>
    <script>
        layui.cache.page = 'user';
        layui.cache.user = {
            username: '{{$user->name}}}'
            ,uid: {{$user->id}}
            ,avatar:'{{\App\Service\Help::getImgSrc(Auth::user()->profile_image)}}'
            //,experience: 83
            ,sex: '{{$user->gender==1?"男":$user->gender==2?"女":"未知"}}'
        };

    </script>
@else
    <script>
        layui.cache.page = 'user';
        layui.cache.user = {
            username: '游客'
            ,uid: -1
            ,avatar: '../images/userimages/default.jpg'
            ,experience: 0
            ,sex: ''
        };

    </script>
@endif