function addJam(jam, where) {
        const url = `${jam.url}/results`;
        const image = `<img class='jam-logo' src='${jam.logo}' />`
        const inner = `${jam.name}`;
        const link = `<a href='${url}' target='_blank'>${inner}</a>`;
        const image_link = `<a href='${url}' target='_blank'>${image}</a>`;
        //const para = `<div class='jam'>${image}</div>`;
        const para = `<div class='jam'>${image_link}<div class='jam-link'>${link}</div></div>`;
        where.innerHTML += `${para}`;
}

$.get(
        "get.php",
        {/*paramOne : 1, paramX : 'abc'*/},
        function(data) {
                const json_data = JSON.parse(data);
                const where = document.getElementById('jam-grid');
                json_data.jams.slice().reverse().forEach(jam => addJam(jam, where));
        }
);
