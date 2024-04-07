import { usePage } from "@inertiajs/vue3";
const getCSRF = () => {
    const page = usePage();
    const csrfToken: string = page.props.csrf_token as string;
    return csrfToken;
};
export function httpGet<T>(url: string): Promise<T> {
    return fetch(url, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    }).then((response) => response.json());
}

export function httpPost<T>(url: string, data: object | object[]): Promise<T> {
    return new Promise((resolve, reject) => {
        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": getCSRF(),
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
