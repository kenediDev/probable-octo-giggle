import axios, { AxiosResponse } from "axios";
import map from "../../components/assets/map.svg";
import ban from "../../components/assets/wheel.svg";
import waiting from "../../components/assets/waiting-room.svg";
import coupon from "../../components/assets/coupon.svg";
import maintenance from "../../components/assets/maintenance.svg";
import ribbon from "../../components/assets/ribbon.svg";
import oilcars from "../../components/assets/car-service (1).svg";
import spooring from "../../components/assets/car-jack.svg";
import tunner from "../../components/assets/radio-tuner.svg";
import tires from "../../components/assets/tires.svg";

const anotherChoice = [
    {
        name: "Promo Ban",
        url: tires,
        description: "Promo Ban Bridgestone, Dunlop, Hankook, GT Radial"
    },
    {
        name: "Promo Oli/Paket Servis",
        url: oilcars,
        description: "Paket Servis Penggantian Oli menggunakan merk Shell"
    },
    {
        name: "Promo Tune Up",
        url: tunner,
        description: "Promo Engine Flush menggunakan produk Liqui Moly"
    },
    {
        name: "Promo Spooring Terbaru",
        url: spooring,
        description: "Promo Spooring Ban"
    }
];

const state = {
    default: [],
    choice: [
        {
            name: "Lokasi Strategis",
            url: map,
            description:
                "Dengan cabang yang tersedia di dekat pusat perbelanjaan. Rasakan kenyamanan servis mobil ketika belanja atau jalan jalan di outlet terdekat"
        },
        {
            name: "Lebih dari 4000 tipe ban",
            description:
                "Dengan lebih dari 4000 tipe ban. Kami akan menyediakan ukuran dan tipe yang sesuai dengan mobil anda",
            url: ban
        },
        {
            name: "Ruang tunggu yang nyaman",
            description:
                "Wi-fi gratis, ruang ber AC, dan kopi atau teh untuk menemani anda ketika menunggu mobil kesayangan anda ditangani oleh mekanik kami",
            url: waiting
        },
        {
            name: "Promo setiap bulan",
            description:
                "Harga terbaik untuk produk dan servis kami. Dengan promo bulanan kami, anda akan mendapatkan deal terbaik untuk kebutuhan mobil anda",
            url: coupon
        },
        {
            name: "Mekanik berpengalaman",
            description:
                "Percayakan kepada mekanik berpengalaman kami untuk kebutuhan servis kendaraan anda",
            url: maintenance
        },
        {
            name: "Garansi lebih panjang",
            description:
                "Garansi lebih kami untuk memanjakan pengalaman servis mobil anda",
            url: ribbon
        }
    ],
    anotherChoice
};

const actions = {
    async listProduct({ commit }: any) {
        return await axios
            .get("/api/v1/default", {
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Methods": "GET",
                    "Access-Control-Allow-Headers":
                        "Content-Type, Origin, Accepted,X-Requested-With",
                    "Access-Control-Allow-Origin": "*"
                },
                timeout: 865000,
                responseType: "json",
                withCredentials: false,
                maxBodyLength: 2000,
                maxContentLength: 2000,
                maxRedirects: 5,
                validateStatus: (status: number) =>
                    status >= 200 && status < 300
            })
            .then((res: AxiosResponse<any>) => {
                commit("listProduct", res.data);
            });
    }
};
const mutations = {
    listProduct: (results: any, data: any) => (results.default = data)
};
const getters = {
    listProduct: (results: any) => results.default,
    choices: (results: any) => results.choice,
    anotherChoices: (results: any) => results.anotherChoice
};
export default {
    state,
    actions,
    mutations,
    getters
};
