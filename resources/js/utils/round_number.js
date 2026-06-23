export default function roundNumber(number) {
    number = parseInt(number);

    const mod = number % 10;
    if (mod > 5){
        return number + (10 - mod);
    }else {
        return number - mod;
    }
}
