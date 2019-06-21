<div class="text-center">
    <small class="text-muted m-1"><strong>{{number_format($fee->payments->count())}}</strong> payment records</small>
    <small class="text-muted m-1"><strong>&#8358;{{number_format($fee->totalPaid())}}</strong>  total received</small>
    <small class="text-muted m-1"><strong>{{number_format($fee->debtors()->count())}}</strong> students owing</small>
    <small class="text-muted m-1"><strong>&#8358;{{number_format($fee->debtors()->sum('balance'))}}</strong> yet to be paid</small>
</div>
