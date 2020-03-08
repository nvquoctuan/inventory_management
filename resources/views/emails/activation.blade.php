Wellcome, {{ $user->name }}
Please active your account: <a href='{{ url("user/active/$user->email/$token") }}'>Link here</a> 