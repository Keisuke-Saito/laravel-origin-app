<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS = [
        1 => [ 'label' => '注文受付', 'class' => 'label-light'],
        2 => [ 'label' => '入金済み', 'class' => 'label-info'],
        3 => [ 'label' => '発送準備', 'class' => 'label-warning'],
        4 => [ 'label' => '発送中', 'class' => 'label-success'],
        5 => [ 'label' => '発送済み', 'class' => 'label-primary'],
        6 => [ 'label' => 'キャンセル', 'class' => 'label-danger'],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    const PAYMENT = [
        1 => ['label' => 'クレジットカード'],
        2 => ['label' => 'コンビニ・ATM払い'],
        3 => ['label' => 'あと払い'],
    ];

    public function getPaymentLabelAttribute()
    {
        $payment = $this->attributes['payment'];

        if (!isset(self::PAYMENT[$payment])) {
            return '';
        }

        return self::PAYMENT[$payment]['label'];
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_details')->withPivot('id', 'quantity');
    }

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
