import React from 'react';
import {StatusBar, View, Platform} from "react-native";

import {RootStack } from './components/Routes'

export default class App extends React.Component{
    static navigationOptions= ({navigation}) =>({
        header: null,
    });
    render() {
        return(
            <View style={{flex: 1}}>
                <StatusBar
                    backgroudColor='#fff'
                    barStyle='dark-content'
                />
                {Platform.OS === 'android' || 'ios' ? <RootStack/> : <RootStack/>}
            </View>
        )
    }
};