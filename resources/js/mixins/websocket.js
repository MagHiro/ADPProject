export default {
    data() {
        return {
            socket: io(process.env.MIX_APP_URL + ':' + process.env.MIX_NODE_PORT),
            event: "Bid:NewBid"
        }
    },
    mounted() {
        console.log('Socket:', this.socket);
        this.socket.on('connect', () => {
            console.log('Connected to Socket.io');
        });
    },
}
