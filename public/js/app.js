$(function(){

    $( '#filter_company_id' ).change(function(){
        const companyId = $( this ).val(),
            search = $( '#search' ).val();
        let url = window.location.href.split('?')[0];
        if (companyId){
            url += `?company_id=${companyId}`
            $( '#search_company_id' ).val( companyId );
        }
        if (search){
            url += (url.indexOf('?') > -1 ? '&' : '?') + `search=${search}`;
        }
        window.location.href = url;
    });

    $( '.btn-delete' ).each(function(){

        $( this ).click(function(e){

            e.preventDefault();

            if (confirm('Are you sure?')){

                const action = $( this ).attr( 'href' );
                $( '#form-delete' ).attr( 'action', action ).submit();
            }
        })
    });

    $( '#btn-clear' ).click(function(){

        $( '#search' ).val( '' );
        $( '#filter_company_id' ).val( '' );

        window.location.href = window.location.href.split('?')[0];
    });
});
