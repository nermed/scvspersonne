import styled from 'styled-components'

export const Wrapper = styled.div`
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid lightblue;
    padding: 5px 5px 20px 5px;

    div {
        flex: 1;
    }
    
    .information, .buttons, .buttons_label {
        display: flex;
        justify-content: space-between;
    }
`