function sortCommentBy(sortBy){
    let url = new URL(window.location.href);

    if(!url.searchParams.has('sortDirection')){
        url.searchParams.append('sortDirection','asc');
        // if(url.searchParams.has('sortBy') && url.searchParams.get('sortBy') === sortBy){
        //     url.searchParams.delete('sortBy');
        // }
        // else{
        // }
        url.searchParams.append('sortBy', sortBy);
    }
    else{
        if(url.searchParams.get('sortDirection') === 'asc'){
            url.searchParams.set('sortDirection','desc');
            if(url.searchParams.has('sortBy') && url.searchParams.get('sortBy') !== sortBy){
                url.searchParams.set('sortBy',sortBy);
                url.searchParams.set('sortDirection', 'asc')
            }
        }
        else{
            url.searchParams.delete('sortDirection');
            if(url.searchParams.has('sortBy') && url.searchParams.get('sortBy') === sortBy){
                url.searchParams.delete('sortBy');
            }
            else{
                url.searchParams.set('sortBy',sortBy);
                url.searchParams.set('sortDirection', 'asc')
            }
        }

    }


    window.location.href = url.href;
}
