export default function formatMoney(amount = 0) {
    const formatter = new Intl.NumberFormat('tr-TR', {});

    return formatter.format(amount);
}
