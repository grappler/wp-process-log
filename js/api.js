'use strict';
;(function(api){

	const url = new URL(api.ajaxurl);

	const apiFetch = (action, data = {})=>{
		url.search = new URLSearchParams({
			action,
			...data
		});
		return fetch(url).then(res => res.json());
	};

	api.fetchProcessList = (page)=> {
		return apiFetch("processes_list",{page});
	};
	api.fetchProcessLogs = (pid) => {
		return apiFetch("process_logs",{pid});
	}

})(ProcessLogAPI);