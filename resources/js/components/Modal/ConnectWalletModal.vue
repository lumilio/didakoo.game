<template>
    <div class="modal1" v-if="show">
        <div class="modal-overlay1" @click="closeModal"></div>
        <div class="connect-modal-content">
            <div style='margin-bottom:10px' class="d-flex container-sm align-items-center justify-content-between flex-row">
                <img class="modal_logo" style='width:100px;' src="../../../images/extra_objects/ddd.jpg">
                <span class="version_sign text-white">v 1.0.5</span>
            </div>
            <!-- <div class="wallet-login-title">
                <h2 class=" mt-4 mb-5 ml-3" style='font-family: "VT323", monospace; color:white;'>
                    Select a way to login
                </h2>
            </div> -->
            <div class="web3-login-buttons">
                <button class="WalletCoinButton" id="guest" @click="web3Login('guest')">
                    <img :src=Guest alt="guest" class="imgSize">
                    <p class="WalletCoinButtonText"> NO WALLET </p>
                </button>
                <button class="WalletCoinButton" @click="web3Login('metamask')" id="metamask">
                    <img :src=MetamaskWalletImg alt="MetamaskWallet" class="imgSize">
                    <p class="WalletCoinButtonText"> METAMASK </p>
                </button>
                <!-- <button class="WalletCoinButton" @click="web3Login('coinbase')" id="coinbase">
                    <img :src=CoinBaseWallet alt="MetamaskWallet" class="imgSize">
                    <p class="WalletCoinButtonText"> COINBASE </p>
                </button> -->
            </div>
            <span v-if="!inGame" class="close1" @click="closeModal" >&times;</span>
            <slot></slot>
        </div>
    </div>
</template>

<script>
import store from "../../store";
import MetamaskWalletImg from "../../../images/extra_objects/MetaMask_Fox.png"
import CoinBaseWallet from "../../../images/extra_objects/CoinBaseWallet.png"
import Guest from "../../../images/extra_objects/ghost.png"
import { ethers as web3 } from '../../../../public/js/ethers';
import NFT_ABI from '../../abis/sunflower1ABI.json';
import Nft9CatABI from '../../abis/nft9catABI.json'
import Nft10Monkey1ABI from '../../abis/nft10Monkey1ABI.json'
import Nft10Monkey2ABI from '../../abis/nft10Monkey2ABI.json'
import Nft11PunksABI from '../../abis/nft11PunksABI.json'
import Nft12MonsterABI from '../../abis/nft12MonsterABI.json'
import Nft13DoodleABI from '../../abis/nft13DoodleABI.json'
import Nft14Sandbox1ABI from '../../abis/nft14Sandbox1ABI.json'
import Nft14Sandbox2ABI from '../../abis/nft14Sandbox2ABI.json'
import Nft15TotemABI from '../../abis/nft15TotemABI.json'
import Nft16NikeABI from '../../abis/nft16NikeABI.json'
import Nft17AdidasABI from '../../abis/nft17AdidasABI.json'
import Nft18PepsiABI from '../../abis/nft18PepsiABI.json'
import Nft19LacosteABI from '../../abis/nft19LacosteABI.json'
import Nft20LandABI from '../../abis/nft20LandABI.json'
import axios from "axios";

const dataNft = [
    {
        nftName: 'sunFlower_1',
        nftContractAddress: '0xd07dc4262BCDbf85190C01c996b4C06a461d2430',
        nftTokenId: '628469'
    },
    {
        nftName: 'sunFlower_2',
        nftContractAddress: '0xBdC8bd87CfD22ef5b90a93A77eeBe5BD0628f841',
        nftTokenId: '2352475547185321859375352175754401687841756219705495990747967153936990732289'
    },
    {
        nftName: 'nft_3_battery',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090346829006776080'
    },
    {
        nftName: 'nft_4_color1',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090345729495139304'
    },
    {
        nftName: 'nft_5_color2',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090344629983511528'
    },
    {
        nftName: 'nft_6_color3',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090343530471883752'
    },
    {
        nftName: 'nft_7_color4',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090342430960255976'
    },
    {
        nftName: 'nft_8_bot1',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090349028030021657'
    },
    {
        nftName: 'nft_8_bot2',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090351227053278159'
    },
    {
        nftName: 'nft_21_raygun',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090347928518394856'
    },
    {
        nftName: 'nft_22_leo_1',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090355625099803288'
    },
    {
        nftName: 'nft_23_leo_2',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090356724611429064'
    },
    {
        nftName: 'nft_24_leo_3',
        nftContractAddress: '0x495f947276749Ce646f68AC8c248420045cb7b5e',
        nftTokenId: '109412144875301169681210938441685435107180596113732411917774090357824123055840'
    },
]

const dataNftCollection = [
    {
        nftName: 'nft_9_cat',
        nftContractAddress: '0x06012c8cf97BEaD5deAe237070F9587f8E7A266d',
        contractABI: Nft9CatABI,
    },
    {
        nftName: 'nft_10_monkey1',
        nftContractAddress: '0xBC4CA0EdA7647A8aB7C2061c2E118A18a936f13D',
        contractABI: Nft10Monkey1ABI,
    },
    {
        nftName: 'nft_10_monkey2',
        nftContractAddress: '0x60E4d786628Fea6478F785A6d7e704777c86a7c6',
        contractABI: Nft10Monkey2ABI,
    },
    {
        nftName: 'nft_11_punks',
        nftContractAddress: '0xb47e3cd837dDF8e4c57F05d70Ab865de6e193BBB',
        contractABI: Nft11PunksABI,
    },
    {
        nftName: 'nft_12_monster',
        nftContractAddress: '0x85F0e02cb992aa1F9F47112F815F519EF1A59E2D',
        contractABI: Nft12MonsterABI,
    },
    {
        nftName: 'nft_13_doodle',
        nftContractAddress: '0x8a90CAb2b38dba80c64b7734e58Ee1dB38B8992e',
        contractABI: Nft13DoodleABI,
    },
    {
        nftName: 'nft_14_sandbox1',
        nftContractAddress: '0x9d305a42A3975Ee4c1C57555BeD5919889DCE63F',
        contractABI: Nft14Sandbox1ABI,
        isPolygon: true,
    },
    {
        nftName: 'nft_14_sandbox2',
        nftContractAddress: '0x7Fbf5C9aF42A6D146dCC18762F515692CD5f853B',
        contractABI: Nft14Sandbox2ABI,
    },
    {
        nftName: 'nft_15_totem',
        nftContractAddress: '0xC2C747E0F7004F9E8817Db2ca4997657a7746928',
        contractABI: Nft15TotemABI,
    },
    {
        nftName: 'nft_16_nike',
        nftContractAddress: '0xF661D58cfE893993b11D53d11148c4650590C692',
        contractABI: Nft16NikeABI,
    },
    {
        nftName: 'nft_17_adidas',
        nftContractAddress: '0x455c732fee7b5c3B09531439B598eaD4817d5274',
        contractABI: Nft17AdidasABI,
    },
    {
        nftName: 'nft_18_pepsi',
        nftContractAddress: '0xa67D63E68715DCF9b65e45e5118b5fcD1e554b5f',
        contractABI: Nft18PepsiABI,
    },
    {
        nftName: 'nft_19_lacoste',
        nftContractAddress: '0xd4190DD1dA460fC7Bc41a792e688604778820aC9',
        contractABI: Nft19LacosteABI,
    },
    {
        nftName: 'nft_20_land',
        nftContractAddress: '0xf87e31492faf9a91b02ee0deaad50d51d56d5d4d',
        contractABI: Nft20LandABI,
    },
]

export default {
    props: {
        show: {
            type: Boolean,
            required: true,

        }
    },
    data(){
        return {
            MetamaskWalletImg: MetamaskWalletImg,
            CoinBaseWallet :CoinBaseWallet,
            Guest :Guest,
            isMobile: false
        }
    },
    methods: {
        checkIfMobile() {
            const userAgent = navigator.userAgent.toLowerCase();
            const mobileKeywords = ['iphone', 'android', 'webos', 'ipad', 'ipod', 'blackberry', 'windows phone'];
            this.isMobile = mobileKeywords.some(keyword => userAgent.includes(keyword));
        },
        closeModal() {
            store.commit('TOGGLE_WALLET_MODAL')
        },
        async fetchAssetTransfers(provider) {
            try {
                const address = await provider.getSigner().getAddress();
                const transfers = await provider.getLogs({
                    fromBlock: '0x0',
                    topics: [
                        web3.utils.keccak256("TransferSingle(address,address,address,uint256,uint256)"),
                        null,
                        web3.utils.padLeft(address, 64) // This ensures the address matches the topic
                    ]
                });

                for (const event of transfers) {
                    const tokenId = web3.utils.toBN(event.data.slice(130)).toString();
                    const contractAddress = `0x${event.address.slice(26)}`;

                    console.log(`Token ID: ${tokenId}, Contract Address: ${contractAddress}`);
                }
            } catch (err) {
                console.error(err);
            }
        },
        async web3Login(wallet) {
            if (this.user) {
                const response = await fetch(process.env.MIX_SERVER_APP_URL +'/api/logout', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                store.commit('LOG_OUT_USER');
            } else {
                try {

                    if (wallet === "guest"){
                      const result = await axios.post(process.env.MIX_SERVER_APP_URL +'/api/login-as-guest', {
                              '_token': document.querySelector('meta[name="csrf-token"]').content
                      });
                      if(result.status !== 200){
                          throw "Bad request";
                      }
                      this.$emit('login')
                        store.commit('LOG_IN_USER', true);
                        store.commit('SET_USER_ADDRESS', result.data.address);
                        this.userData = {address: result.data.address, balance: 0, power: 0, color_id: 1};
                        store.commit('SET_USER_DATA', {color_id: this.userData.color_id , power :this.userData.power})
                        store.commit('TOGGLE_WALLET_MODAL');
                        toastr.success('Log in successfully!');
                      return;
                    }
                    let provider = {};

                    if (!window.ethereum) {
                        toastr.error('MetaMask not found.');
                        return;
                    }

                    try {
                        if (this.isMobile && wallet === 'metamask' && !window.ethereum) {
                            window.location = 'https://metamask.app.link/dapp/'+process.env.MIX_SERVER_APP_URL;
                        }
                        provider = wallet === 'metamask' ? window.ethereum.providers.find((provider) => provider.isMetaMask) : window.ethereum.providers.find((provider) => provider.isCoinbaseWallet);
                        provider = new ethers.providers.Web3Provider(provider);
                    }catch (e) {
                        if (wallet === 'metamask'){
                            provider = new ethers.providers.Web3Provider(window.ethereum);
                        }else{
                            toastr.error('Coinbase not detected.Please install Coinbase first.');
                        }
                    }

                    let response = await fetch(process.env.MIX_SERVER_APP_URL +'/api/web3-login-message');
                    const message = await response.text();

                    await provider.send("eth_requestAccounts", []);
                    const address = await provider.getSigner().getAddress();
                    const amount = await provider.getSigner().getBalance();
                    const signature = await provider.getSigner().signMessage(message);

                    response = await fetch(process.env.MIX_SERVER_APP_URL +'/api/web3-login-verify', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            'message': message,
                            'address': address,
                            'signature': signature,
                            '_token': document.querySelector('meta[name="csrf-token"]').content
                        })
                    });
                    const data = response.statusText;
                    const date = new Date();
                    let day = date.getDate();
                    let year = date.getFullYear();
                    let month = date.getMonth() + 1;
                    let hour = date.getHours();
                    let min = date.getMinutes();
                    let sec = date.getSeconds();

                    var alias = "player_" + year + "" + month + "" + day + "" + hour + "" + min + "" + sec + "";
                    if (data === "OK") {
                        this.$emit('login')
                        store.commit('LOG_IN_USER', true)
                        store.commit('SET_USER_ADDRESS', address)
                        store.commit('TOGGLE_WALLET_MODAL')

                        const getUsersResponse = await axios.get(process.env.MIX_SERVER_APP_URL+`/api/get-users`);
                        const playersArray = getUsersResponse.data.users;
                        const currentLoggedInPlayerNumber = playersArray.findIndex((player) => player.wallet_address == address) + 1
                        store.commit('SET_PLAYER_NUMBER', currentLoggedInPlayerNumber)

                        this.$emit("close");
                        toastr.success('Log in successfully!');
                        try {
                          response = await axios.post(process.env.MIX_SERVER_APP_URL +'/api/web3-register-ethwallet', {
                            'wallet_address': address,
                            'balance': amount['_hex'],
                            'alias': alias,
                            '_token': document.querySelector('meta[name="csrf-token"]').content
                          });
                        }catch (error){
                          console.log(error,'error')
                        }

                        if (response.data !== "SUCCESS") {
                            response = axios.post(process.env.MIX_SERVER_APP_URL +'/api/web3-update-ethwallet', {
                                    'ethwalletaddr': address,
                                    'balance': amount['_hex'],
                                    '_token': document.querySelector('meta[name="csrf-token"]').content
                            });
                            console.log("Update successfully!");
                        } else {
                            console.log("Register successfully!");
                        }
                        try {
                            const postData = {player: address};
                            for (const nft of dataNft) {
                                const contract = new web3.Contract(nft.nftContractAddress, NFT_ABI,provider);
                                const nftName = await contract.balanceOf(address, nft.nftTokenId);
                                postData[nft.nftName] = nftName.toString();
                            }
                            await axios.post('/api/if-there-nft', postData);
                        }catch (error) {
                            console.error(error)
                        }
                        try {
                            const postDataCollection = {player: address}
                            for (const nft of dataNftCollection) {
                                if(nft.isPolygon){
                                    const provider = new ethers.providers.JsonRpcProvider("https://polygon-mainnet.g.alchemy.com/v2/" + process.env.MIX_ALCHEMY_API_KEY);
                                    const contract = new web3.Contract(nft.nftContractAddress, nft.contractABI,provider);
                                    const nftName = await contract.balanceOf(address);
                                    postDataCollection[nft.nftName] = nftName.toString()
                                }else{
                                    const contract = new web3.Contract(nft.nftContractAddress, nft.contractABI,provider);
                                    const nftName = await contract.balanceOf(address);
                                    postDataCollection[nft.nftName] = nftName.toString()
                                }
                            }
                            await axios.post('/api/nft-Collection', postDataCollection);
                            const response = await axios.get(`/api/user-by-wallet-address/${address}`);
                            this.userData = response.data.user;
                            store.commit('SET_USER_DATA', {color_id: this.userData.color_id , power :this.userData.power})
                            store.commit('TOGGLE_WALLET_MODAL');
                            store.commit('TOGGLE_WALLET_MODAL');


                        }catch (error){
                            console.error(error)
                        }
                    } else {
                        toastr.error('access denied')
                        console.log('access denied');
                    }
                }catch (e) {

                }
            }
        }
    },
    getStatus: function () {
        setInterval( async function()
        {
            const {ethereum} = window;
            const accounts = await ethereum.request({method: 'eth_accounts'});
            console.log(accounts);
            if (accounts && accounts.length > 0) {
                this.test = true;
            }
            else{
                // console.log('user not logged in');
                this.test = false;
            }
        },2000);
    },
    watch:{
        test()
        {
            this.getStatus();
        }
    },
    computed:{
            inGame(){
                return window.location.pathname.includes('room')
            }
    },
    mounted () {
        toastr.options.timeOut = 1500;
        this.checkIfMobile();
        window.addEventListener('resize', this.checkIfMobile);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.checkIfMobile);
    },
}
</script>

<style>
/* Style the modal */
.modal1 {

    position: absolute;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow-y: hidden;
    display: flex;
    justify-content: center;
    align-items: center;

}

.modal-overlay1 {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    /* background-color: rgba(0, 0, 0, 0.4); NO DARK BACKGROUND for NOW */
}

/* Modal Content/Box */
.connect-modal-content {
    background: black;
    padding: 20px;
    width: 350px;
    /* height: 440px; */
    overflow: auto;
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 15px;
    justify-content: center;
    margin: 15% auto;
    border-radius: 20px;
    min-width: 350px;
    align-items: center;

}

/* The Close Button */
.close1 {
    color:red;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 5px;
    right: 10px;
    cursor: pointer;
}

.close1:hover {
    color: darkred;
}

.WalletCoinButtonText{
    margin: 0;
    align-self: center;
    text-transform: uppercase;
    background-clip: border-box;
    color: #fff;
    font-size: 13px;
}
.WalletCoinButton{
    background: black;
    border-radius: 8px;
    min-height: auto;
    height: 42px;
    border: 1px solid rgba(255, 255, 255, 0.2196078431);
    padding: 0 5px;
    box-shadow: 0 0 6px 1px rgba(255, 255, 255, 0.43);
    transition: 0.2s ease;
    width: 150px;
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.WalletCoinButton:hover {
    box-shadow: 0 0 7px 1px rgba(255, 255, 255, 0.5);
    transform: scale(1.02);
}
.imgSize{
    max-width: 35px;
    margin: 0;
    align-self: center;
    padding: 2px 0;

}
</style>
