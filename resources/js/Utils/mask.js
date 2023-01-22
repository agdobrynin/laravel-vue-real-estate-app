export const MASK_PRICE = {
    mask: '9 99#',
    returnUnmasked: true,
    reversed: true,
    tokens: {
        '9': {
            pattern: '[0-9]', repeated: true, multiple: true,
        },
    },
}

export const MASK_NUMBER = {
    mask: '9',
    tokens: {
        '9': {
            pattern: '[0-9]', repeated: true, multiple: true,
        },
    },
}
