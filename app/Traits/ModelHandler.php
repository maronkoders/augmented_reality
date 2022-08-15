<?php


namespace  App\Traits;

trait ModelHandler
{
     public function getRecords($recordName, \Illuminate\Database\Eloquent\Model $model)
        {
            try {
                return response()->json(['status' => true,$recordName => $model::all()]);
            } catch (\Throwable $th) {
                return response()->json(['status' => false,'message' => $th->getMessage()]);
            }
        }
}
