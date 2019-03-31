import React, {Component} from 'react';
import {StyleSheet, Text, View} from 'react-native';
import CheckBox from 'react-native-check-box'

type Props = {};
export default class ScheduleAdd extends Component<Props> {
    constructor(props){
        super(props);
        this.state={
            isChecked:false
        }
    }
    render() {
        return (
            <View style={styles.container}>
                <Text>Like it</Text>
                <CheckBox
                    style={{flex: 1, padding: 10}}
                    onClick={()=>{
                        this.setState({
                            isChecked:!this.state.isChecked
                        })
                    }}
                    isChecked={this.state.isChecked}
                />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        flexDirection: 'row',
    },
});