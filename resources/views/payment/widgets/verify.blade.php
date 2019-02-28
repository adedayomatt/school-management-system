<form action="{{route('payment.verify')}}" class="form-inline">
    <input type="text" class="form-control" name="ref" placeholder="Enter payment ref..." value="{{isset($ref) ? $ref : ''}}" style="width: 300px;border-radius: 3px 0px 0px 3px" >
    <button type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-check-double"></i> verify payment</button>
</form>