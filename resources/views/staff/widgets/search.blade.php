<form action="{{route('staff.file.search')}}" class="form-inline">
    <input type="text" class="form-control staff-search" name="q" placeholder="search for staff..." value="{{isset($keyword) ? $keyword : ''}}" style="width: 300px;border-radius: 3px 0px 0px 3px" >
    <button type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-search"></i> search</button>
</form>