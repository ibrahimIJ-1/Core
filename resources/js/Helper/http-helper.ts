import { usePage } from "@inertiajs/vue3";

export function httpGet(url: string) {
    return fetch(url, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    }).then((response) => response.json());
}

export function httpPost(url: string, data: object | object[]) {
    const page = usePage();
    const csrfToken: string = page.props.csrf_token as string;
    return new Promise((resolve, reject) => {
        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(data),
        }).then((response) => {
            if (response.ok) {
                resolve(response.json());
            } else {
                response.json().then((data) => {
                    reject({ response, error: data });
                });
            }
        });
    });
}
