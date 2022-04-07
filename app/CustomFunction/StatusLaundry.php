<?php
    use Illuminate\Support\Facades\DB;
    
    if(!function_exists('statusLaundry')){
        function statusLaundry(){
            $idLaundry = session()->get('id');
            $isActive  = new \stdClass;
            $isActive->value = DB::table('pengusaha')
                        ->where('id', $idLaundry)
                        ->where('status', 'Aktif')
                        ->first();
            $isActive->value !== null ? $isActive->value = true : $isActive->value = false;
            $isActive->message = 'Mohon maaf akun anda belum aktif';
            // dd($isActive);
            return $isActive;
        }
    }
    
    
?>