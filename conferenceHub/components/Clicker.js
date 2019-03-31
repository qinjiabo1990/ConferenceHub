import React, { Component } from 'react'

import {
    View,
    WebView,
    StyleSheet
} from 'react-native'

export default class Clicker extends Component {
    static navigationOptions= ({navigation}) =>({
        title: 'Clicker',
        headerRight: <View />,
    });

    render() {
        return (
            <View style = {styles.container}>
                <WebView
                    source = {{ uri:'https://student.turningtechnologies.com/#/profile'}}
                />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        height: '100%',
        width: '100%',
    }
})